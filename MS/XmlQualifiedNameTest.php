<?php

/**
 * Part of the XML Schema library for PHP
 *  _                      _     _ _ _
 * | |   _   _  __ _ _   _(_) __| (_) |_ _   _
 * | |  | | | |/ _` | | | | |/ _` | | __| | | |
 * | |__| |_| | (_| | |_| | | (_| | | |_| |_| |
 * |_____\__, |\__, |\__,_|_|\__,_|_|\__|\__, |
 *       |___/    |_|                    |___/
 *
 * @author Bill Seddon
 * @version 0.9
 * @Copyright (C) 2018 Lyquidity Solutions Limited
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace lyquidity\xml\MS;

use lyquidity\xml\QName;

/**
 *
 * Summary: XmlQualifiedName extends XmlQualifiedName to support wildcards and adds nametest functionality
     Following are the examples:
         {A}:B     XmlQualifiedNameTest.New("B", "A")        Match QName with namespace A        and local name B
         *         XmlQualifiedNameTest.New(null, null)      Match any QName
         {A}:*     XmlQualifiedNameTest.New(null, "A")       Match QName with namespace A        and any local name
                   XmlQualifiedNameTest.New("A", false)
         *:B       XmlQualifiedNameTest.New("B", null)       Match QName with any namespace      and local name B
         ~{A}:*    XmlQualifiedNameTest.New("B", "A")        Match QName with namespace not A    and any local name
         {~A}:B    only as a result of the intersection      Match QName with namespace not A    and local name B
 *
 */
/**
 * XmlQualifiedNameTest (public)
 */
class XmlQualifiedNameTest extends QName
{
	/**
	 * Holds the value passed in to the constructor.  When true the test is negated
	 * @var bool $exclude
	 */
	 private $exclude;

	/**
	 * @var string wildcard = "*"
	 */
	const wildcard = "*";

	/**
	 * @var XmlQualifiedNameTest $wc = XmlQualifiedNameTest.New(wildcard, wildcard)
	 */
	static $wc;

	/**
	 * Initialize the static class
	 */
	public static function __static()
	{
		XmlQualifiedNameTest::$wc = XmlQualifiedNameTest::create( XmlQualifiedNameTest::wildcard, XmlQualifiedNameTest::wildcard );
	}

	/**
	 * Full wildcard
	 * @var XmlQualifiedNameTest $Wildcard
	 */
	public static function getWildcard()
	{
		return XmlQualifiedNameTest::$wc;
	}

	/**
	 * Constructor
	 * @param string $name
	 * @param string $ns
	 * @param bool $exclude
	 */
	public function __construct( $name, $ns, $exclude )
	{
		parent::__construct( "", $ns, $name );
		$this->exclude = $exclude;
	}

	/**
	 * Construct new from name and namespace. Returns singleton Wildcard in case full wildcard
	 * @param string $name optional default is *
	 * @param string $ns optional default is *
	 * @return XmlQualifiedNameTest
	 */
	public static function create( $name = null, $ns = null)
	{
		if ( $name instanceof QName )
		{
			/**
			 * @param QName $qn
			 */
			$qn =& $name;

            if ( $qn->isEmpty() )
			{
                return XmlQualifiedNameTest::getWildcard();
			}
            else
			{
                return new XmlQualifiedNameTest(
					empty( $qn->localName )
						? XmlQualifiedNameTest::wildcard
						: $qn->localName,
                    empty( $qn->namespaceURI )
						? XmlQualifiedNameTest::wildcard
						: $qn->namespaceURI,
					false
				);
			}
		}
		else
		{
			if ( is_null( $ns ) && is_null( $name ) )
			{
				return XmlQualifiedNameTest::getWildcard();
			}
			else
			{
				return new XmlQualifiedNameTest(
					is_null( $name )
						? XmlQualifiedNameTest::wildcard
						: $name,
					is_null( $ns )
						? XmlQualifiedNameTest::wildcard
						: $ns,
					false
				);
			}
		}
	}

	/**
	 * True if matches any name and any namespace
	 * @var bool $IsWildcard
	 */
	public function IsWildcard()
	{
		return $this->IsNameWildcard() && $this->IsNamespaceWildcard();
	}

	/**
	 * True if matches any name
	 * @return bool
	 */
	public function IsNameWildcard()
	{
		return $this->localName == XmlQualifiedNameTest::wildcard;
	}

	/**
	 * True if matches any namespace
	 * @return bool
	 */
	public function IsNamespaceWildcard()
	{
		return $this->namespaceURI == XmlQualifiedNameTest::wildcard;
	}

	/**
	 * IsNameSubsetOf
	 * @param XmlQualifiedNameTest $other
	 * @return bool
	 */
	private function IsNameSubsetOf( $other )
	{
		return $other->IsNameWildcard() || $this->localName == $other->localName;
	}

	/**
	 * IsNamespaceSubsetOf
	 * @param XmlQualifiedNameTest $other
	 * @return bool
	 */
	private function IsNamespaceSubsetOf( $other )
	{
		return $other->IsNamespaceWildcard()
			|| ( $this->exclude == $other->exclude && $this->namespaceURI == $other->namespaceURI )
			|| ( $other->exclude && ! $this->exclude && $this->namespaceURI != $other->namespaceURI );
	}

	/**
	 * True if this matches every QName other does
	 * @param XmlQualifiedNameTest $other
	 * @return bool
	 */
	public function IsSubsetOf( $other )
	{
		return $this->IsNameSubsetOf( $other ) && $this->IsNamespaceSubsetOf( $other );
	}

	/**
	 * Return true if the result of intersection with other is not empty
	 * @param XmlQualifiedNameTest $other
	 * @return bool
	 */
	public function HasIntersection( $other )
	{
		return
			( $this->IsNamespaceSubsetOf( $other ) || $other->IsNamespaceSubsetOf( $this ) ) &&
			( $this->IsNameSubsetOf( $other ) || $other->IsNameSubsetOf( $this ) );
	}

	/**
	 * String representation
	 * @return string
	 */
	public function ToString()
	{
		if ( $this->IsWildcard() )
		{
			return "*";
		}
		else
		{
			if ( empty( $this->namespaceURI ) )
			{
				return $this->localName;
			}
			else if ( $this->IsNamespaceWildcard() )
			{
				return "*:" . $this->localName;
			}
			else if ( $this->exclude )
			{
				return "{~" . $this->namespaceURI . "}:" . $this->localName;
			}
			else
			{
				return "{" . $this->namespaceURI . "}:" . $this->localName;
			}
		}
	}

}

XmlQualifiedNameTest::__static();

?>
