<?php
/**
 * EarthAsylum Consulting {eac} Software Registration - software registration includes
 *
 * includes the interfaces and traits used by the software registration API
 *
 * @category	WordPress Plugin
 * @package		{eac}SoftwareRegistry
 * @author		Kevin Burkholder <KBurkholder@EarthAsylum.com>
 * @copyright	Copyright (c) 2025 EarthAsylum Consulting <www.EarthAsylum.com>
 * @version		25.0725.1
 */

/*
 *	class <yourclassname> [extends something] implements \EarthAsylumConsulting\softwareregistry_interface
 *	{
 *		use \EarthAsylumConsulting\Traits\softwareregistry_wordpress;
 *				- OR -
 *		use \EarthAsylumConsulting\Traits\softwareregistry_filebased;
 *		...
 *	}
 */

/*
 * include interface...
 */
	require "softwareregistry.interface.php";

/*
 * include traits ...
 */
	require "softwareregistry.interface.trait.php";

/*
 *	require "softwareregistry.wordpress.trait.php";
 *				- OR -
 *	require "softwareregistry.filebased.trait.php";
 */
 	require "softwareregistry.<wordpress_or_filebased>.trait.php";
