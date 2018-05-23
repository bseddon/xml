<?php

/**
 * QName class and factory functions.  This is ported from Arelle.
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

namespace lyquidity\xml;

/**
 * Represents a namespace, prefix and localname
 */
class QName
{
	/**
	 * The QName prefix
	 * @var string
	 */
	public $prefix;

	/**
	 * The QName namespace
	 * @var string
	 */
	public $namespaceURI;

	/**
	 * The QName local name
	 * @var string
	 */
	public $localName;

	/**
	 * A hash of the QName
	 * @var string
	 */
	private $qnameValueHash;

	/**
	 * Default constructor
	 *
	 * @param string $prefix
	 * @param string $namespaceURI
	 * @param string $localName
	 */
	public function __construct( $prefix, $namespaceURI, $localName )
	{
		$this->prefix = $prefix;
		$this->namespaceURI = $namespaceURI;
		$this->localName = $localName;
		$this->qnameValueHash = hash( 'sha256', serialize( array( $this->namespaceURI, $this->localName ) ) );
	}

	/**
	 * Return the hash of the QName
	 *
	 * @return string
	 */
	public function getHash()
	{
		return $this->qnameValueHash;
	}

	/**
	 * Return a representation of the QName using a clark notation {namespace}prefix:name
	 *
	 * @return string
	 */
	public function clarkNotation()
	{
		if ( $this->namespaceURI )
		{
			return sprintf( '{%s}%s', $this->namespaceURI, $this->localName );
		}
		else
		{
			return $this->localName;
		}
	}

	/**
	 * Create a string representation
	 *
	 * @return number|string
	 */
	public function __toString()
	{
		$namespaceURI = empty( $this->namespaceURI )
			? ""
			: "{{$this->namespaceURI}}";

		return $namespaceURI . $this->localName;
	}

	/**
	 * Test whether one QName equals another
	 *
	 * @param QName $other
	 * @return boolean
	 */
	public function equals( $other )
	{
		try
		{
			return $this->qnameValueHash == $other->qnameValueHash ||
				( $this->localName == $other->localName && $this->namespaceURI == $other->namespaceURI );
		}
		catch( \Exception $ex )
		{
			return false;
		}
	}

	/**
	 * Test whether one QName is less than another
	 *
	 * @param QName $other
	 * @return boolean
	 */
	public function lessThan( $other )
	{
		return $this->namespaceURI == null && $other->namespaceURI ||
		$this->namespaceURI && $other->namespaceURI && $this->namespaceURI < $other->namespaceURI ||
		$this->namespaceURI == $other->namespaceURI && $this->localName < $other->localName;
	}

	/**
	 * Test whether one QName is less than or equal to another
	 *
	 * @param QName $other
	 * @return boolean
	 */
	public function lessThanOrEqual( $other )
	{
		return $this->namespaceURI == null && $other->namespaceURI ||
		$this->namespaceURI && $other->namespaceURI && $this->namespaceURI < $other->namespaceURI ||
		$this->namespaceURI == $other->namespaceURI && $this->localName <= $other->localName;
	}

	/**
	 * Test whether one QName is greater than another
	 *
	 * @param QName $other
	 * @return boolean
	 */
	public function greaterThan( $other )
	{
		return $this->namespaceURI && $other->namespaceURI == null ||
		$this->namespaceURI && $other->namespaceURI && $this->namespaceURI > $other->namespaceURI ||
		$this->namespaceURI == $other->namespaceURI && $this->localName > $other->localName;
	}

	/**
	 * Test whether one QName is greater or equal to another
	 *
	 * @param QName $other
	 * @return boolean
	 */
	public function greaterThanOrEqual( $other )
	{
		return $this->namespaceURI && $other->namespaceURI == null ||
		$this->namespaceURI && $other->namespaceURI && $this->namespaceURI > $other->namespaceURI ||
		$this->namespaceURI == $other->namespaceURI && $this->localName >= $other->localName;
	}

	/**
	 * Returns true if the QName is valid
	 *
	 * @return unknown
	 */
	public function isValid()
	{
		// QName object bool is false if there is no local name (even if there is a namespace URI).
		return (bool) $this->localName;
	}

	/**
	 * Returns true is both the local name and namespace are empty
	 * @return boolean
	 */
	public function isEmpty()
	{
		return empty( $this->localName ) && empty( $this->namespaceURI );
	}

	/**
	 * Convert the QName to an array
	 */
	public function toArray()
	{
		$result = array( 'localname' => $this->localName );
		if ( isset( $this->prefix ) ) array( 'prefix' => $this->prefix );
		if ( isset( $this->namespaceURI ) ) array( 'namespace' => $this->namespaceURI );
		return $result;
	}
}
