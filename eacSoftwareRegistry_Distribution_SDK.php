<?php
/**
 * EarthAsylum Consulting {eac} Software Registration Server - Distribution SDK
 *
 * @category	WordPress Plugin
 * @package		{eac}SoftwareRegistry Distribution SDK
 * @author		Kevin Burkholder <KBurkholder@EarthAsylum.com>
 * @copyright	Copyright (c) 2026 EarthAsylum Consulting <www.earthasylum.com>
 * @link		https://swregistry.earthasylum.com/
 * @link 		https://swregistry.earthasylum.com/software-registry-sdk/
 * @link 		https://wordpress.org/plugins/eacsoftwareregistry-distribution-sdk
 * @link 		https://github.com/EarthAsylum/eacSoftwaReregistry-distribution-sdk
 *
 * @wordpress-plugin
 * Plugin Name:	        {eac}SoftwareRegistry Distribution SDK
 * Description:	        Software Registration Server Distribution SDK - generate custom PHP packages that can be include in your project to register your product with your registration server.
 * Version:	            1.2.0
 * Requires at least:   5.8
 * Tested up to:        7.1
 * Requires PHP:        8.2
 * Plugin URI:        	https://swregistry.earthasylum.com/software-registry-sdk/
 * Author:				EarthAsylum Consulting
 * Author URI:			http://www.earthasylum.com
 * License: 			GPLv3 or later
 * License URI: 		https://www.gnu.org/licenses/gpl.html
 * Text Domain:			eacSoftwareRegistry
 * Domain Path:			/languages
 */

/**
 * This simple plugin file responds to the 'eacSoftwareRegistry_load_extensions' filter to load additional extensions.
 * Using this method prevents overwriting extensions when the plugin is updated or reinstalled.
 */

namespace EarthAsylumConsulting;

if (! class_exists( 'EarthAsylumConsulting\eacSoftwareRegistry', false ) )
{
	require_once 'dependency.php';
	return dependency::notice([
		'plugin'	=>	[ '{eac}SoftwareRegistry Distribution SDK' => plugin_basename( __FILE__ ) ],
		'requires'	=> 	[ '{eac}SoftwareRegistry' => 'eacSoftwareRegistry/eacSoftwareRegistry.php' ],
		'manifest'	=> 'https://swregistry.earthasylum.com/software-updates/eacSoftwareRegistry.json',
		'after'		=> '/wp-admin/edit.php?post_type=softwareregistry&page=eacsoftwareregistry-settings&tab=registration'
	]);
}

define('EAC_SOFTWARE_REGISTRY_SDK', __DIR__);

class eacSoftwareRegistry_Distribution_SDK
{
	/**
	 * constructor method
	 *
	 * @return	void
	 */
	public function __construct()
	{
		/**
		 * eacSoftwareRegistry_load_extensions - get the extensions directory to load
		 *
		 * @param 	array	$extensionDirectories - array of [plugin_slug => plugin_directory]
		 * @return	array	updated $extensionDirectories
		 */
		add_filter( 'eacSoftwareRegistry_load_extensions',	function($extensionDirectories)
			{
				if (is_admin())
				{
					/*
					 * Enable update notice (self hosted or wp hosted)
					 */
					eacSoftwareRegistry::loadPluginUpdater(__FILE__,'wp');

					/*
					 * Add links on plugins page
					 */
					add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ),function($pluginLinks, $pluginFile, $pluginData)
						{
							return array_merge(
								[
									'settings'		=> eacSoftwareRegistry::getSettingsLink($pluginData,'distribution'),
									'documentation'	=> eacSoftwareRegistry::getDocumentationLink($pluginData),
									'support'		=> eacSoftwareRegistry::getSupportLink($pluginData),
								],
								$pluginLinks
							);
						},20,3
					);
				}

				/*
    			 * Add our extension to load
    			 */
				$extensionDirectories[ plugin_basename( __FILE__ ) ] = [plugin_dir_path( __FILE__ )];
				return $extensionDirectories;
			}
		);
	}
}
new \EarthAsylumConsulting\eacSoftwareRegistry_Distribution_SDK();
?>
