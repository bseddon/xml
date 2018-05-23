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
 * along with this program.  If not, see <http: *www.gnu.org/licenses/>.
 *
 */

namespace lyquidity\xml\xpath;

use lyquidity\xml\interfaces\ICloneable;
use lyquidity\xml\MS\IXmlNamespaceResolver;
use lyquidity\xml\xpath\XPathItem;
use lyquidity\xml\xpath\IXPathNavigable;
use lyquidity\xml\exceptions\NotSupportedException;

/**
 * Provides a cursor model for navigating and editing XML data.
 */
abstract class XPathNavigator implements XPathItem, ICloneable, IXPathNavigable, IXmlNamespaceResolver
{
	/**
	 * Used
	 * Gets an IEqualityComparer used for equality comparison of XPathNavigator objects.
	 *
	 * @return IEqualityComparer An IEqualityComparer used for equality comparison of XPathNavigator objects.
	 */
	public static abstract function getNavigatorComparer();

	/**
	 * Used
	 * When overridden in a derived class, gets the base URI for the current node.
	 *
	 * @return string $BaseURI The location from which the node was loaded, or Empty if there is no value.
	 */
	public abstract function getBaseURI();

	/**
	 * Not used
	 * Gets a value indicating whether the XPathNavigator can edit the underlying XML data.
	 *
	 * @return bool $CanEdit true if the XPathNavigator can edit the underlying XML data; otherwise false.
	 */
	public function CanEdit()
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Used
	 * Gets a value indicating whether the current node has any attributes.
	 *
	 * @var bool $HasAttributes
	 *     Returns true if the current node has attributes; returns false if the current
	 *     node has no attributes, or if the XPathNavigator is not positioned
	 *     on an element node.
	 */
	public abstract function getHasAttributes();

	/**
	 * Gets a value indicating whether the current node has any child nodes.
	 * @param XPathNodeType $type
	 * @return bool $HasChildren true if the current node has any child nodes; otherwise, false.
	 */
	public function getHasChildren( $type = null )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used but implement
	 * Gets or sets the markup representing the child nodes of the current node.
	 *
	 * @return string A string that contains the markup of the child nodes of the current node.
	 */
	public abstract function getInnerXml();

	/**
	 * Not used but implement
	 * When overridden in a derived class, gets a value indicating whether the current
	 * node is an empty element without an end element tag.
	 *
	 * @return bool true if the current node is an empty element; otherwise, false.
	 */
	public abstract function getIsEmptyElement();

	/**
	 * Used
	 * When overridden in a derived class, gets the XPathNavigator.Name
	 * of the current node without any namespace prefix.
	 *
	 * @return string A string that contains the local name of the current node, or Empty
	 *     if the current node does not have a name (for example, text or comment nodes).
	 */
	public abstract function getLocalName();

	/**
	 * Used
	 * When overridden in a derived class, gets the qualified name of the current node.
	 *
	 * @return string A string that contains the qualified XPathNavigator.Name of the
	 *     			  current node, or Empty if the current node does not have a name
	 * 				  (for example, text or comment nodes).
	 */
	public abstract function getName();

	/**
	 * Used
	 * When overridden in a derived class, gets the namespace URI of the current node.
	 *
	 * @return string  A string that contains the namespace URI of the current node,
	 *    			   or Empty if the current node has no namespace URI.
	 */
	public abstract function getNamespaceURI();

	/**
	 * Used
	 * When overridden in a derived class, gets the XmlNameTable of the XPathNavigator.
	 *
	 * @return XmlNameTable An XmlNameTable object enabling you to get the atomized
	 * 						version of a string within the XML document.
	 */
	public abstract function getNameTable();

	/**
	 * Used
	 * When overridden in a derived class, gets the XPathNodeType of the current node.
	 *
	 * @return XPathNodeType One of the XPathNodeType values representing the current node.
	 */
	public abstract function getNodeType();

	/**
	 * Used
	 * Gets or sets the markup representing the opening and closing tags of the current node and its child nodes.
	 *
	 * @return string A string that contains the markup representing the opening and closing
	 *    			  tags of the current node and its child nodes.
	 */
	public abstract function getOuterXml();

	/**
	 * Used
	 * When overridden in a derived class, gets the namespace prefix associated with the current node.
	 *
	 * @return string A string that contains the namespace prefix associated with the current node.
	 */
	public abstract function getPrefix();

	/**
	 * Used
	 * Gets the schema information that has been assigned to the current node as a result of schema validation.
	 *
	 * @return IXmlSchemaInfo An IXmlSchemaInfo object that contains the schema information
	 * 						  for the current node.
	 */
	public abstract function getSchemaInfo();

	/**
	 * Not used but implement
	 * Used by XPathNavigator implementations which provide a "ized" XML view over a store,
	 * to provide access to underlying objects.
	 *
	 * @return \DOMNode The default is null.
	 */
	public abstract function getUnderlyingObject();

	/**
	 * Not used but implement
	 * Gets the xml:lang scope for the current node.
	 *
	 * @return string $XmlLang
	 *     A string that contains the value of the xml:lang scope, or Empty
	 *     if the current node has no xml:lang scope value to return.
	 */
	public abstract function getXmlLang();

	/**
	 * Checks to determine if the current node is an ancestor of $target
	 * @param \DOMNode $target The node to determine if the current node is an ancestor
	 * @return bool
	 */
	public abstract function isNodeAncestorOf( $target );

	/**
	 * Not used
	 * Creates a new child node at the end of the list of child nodes of the current
	 * node using the XML data string specified.
	 *
	 * @param string|XmlReader|XPathNavigator $newChild  The XML data string for the new child node.
	 *
	 * @return void
	 *
	 * @throws
	 *   ArgumentNullException The XML data string parameter is null.
	 *   InvalidOperationException The current node the XPathNavigator is positioned on is not the root node or an element node.
	 *   NotSupportedException The XPathNavigator does not support editing.
	 *   XmlException The XML data string parameter is not well-formed.
	 */
	public function AppendChild( $newChild )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Creates a new child element node at the end of the list of child nodes of the
	 * current node using the namespace prefix, local name and namespace URI specified
	 *     with the value specified.
	 *
	 * @param string $prefix The namespace prefix of the new child element node (if any).
	 * @param string $localName The local name of the new child element node (if any).
	 * @param string $namespaceURI The namespace URI of the new child element node (if any). Empty and null are equivalent.
	 * @param string $value The value of the new child element node. If Empty or null are passed, an empty element is created.
	 *
	 * @return void
	 *
	 * @throws
	 *   InvalidOperationException The current node the XPathNavigator is positioned on is not the root node or an element node.
	 *   NotSupportedException The XPathNavigator does not support editing.
	 */
	public function AppendChildElement( $prefix, $localName, $namespaceURI, $value )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Verifies that the XML data in the XPathNavigator conforms to
	 * the XML Schema definition language (XSD) schema provided.
	 *
	 * @param XmlSchemaSet $schemas The XmlSchemaSet containing the schemas used to validate the XML data contained in the XPathNavigator.
	 * @param ValidationEventHandler $validationEventHandler The ValidationEventHandler that receives information about schema validation warnings and errors.
	 *
	 * @return bool true if no schema validation errors occurred; otherwise, false.
	 *
	 * @throws
	 *   XmlSchemaValidationException A schema validation error occurred, and no ValidationEventHandler was specified to handle validation errors.
	 *   InvalidOperationException The XPathNavigator is positioned on a node that is not an element, attribute, or the root node or there is not type information to perform validation.
	 *   ArgumentException The XPathNavigator.CheckValidity(XmlSchemaSet,ValidationEventHandler) method was called with an XmlSchemaSet parameter when the XPathNavigator was not positioned on the root node of the XML data.
	 */
	public function CheckValidity( $schemas, $validationEventHandler )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Used
	 * When overridden in a derived class, creates a new XPathNavigator
	 * positioned at the same node as this XPathNavigator.
	 *
	 * @return XPathNavigator A new XPathNavigator positioned at the same node as this XPathNavigator.
	 */
	public abstract function CloneInstance();

	/**
	 * Compares the position of the current XPathNavigator with the
	 * position of the XPathNavigator specified.
	 *
	 * @param XPathNavigator $nav The XPathNavigator to compare against.
	 * @param $useLineNo
	 * @return XmlNodeOrder An XmlNodeOrder value representing the comparative position of the two XPathNavigator objects.
	 */
	public function ComparePosition( $nav, $useLineNo )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Compiles a string representing an XPath expression and returns an XPathExpression object.
	 *
	 * @param string $xpath A string representing an XPath expression.
	 *
	 * @return XPathExpression An XPathExpression object representing the XPath expression.
	 *
	 * @throws
	 *   ArgumentException The xpath parameter contains an XPath expression that is not valid.
	 *   XPathException The XPath expression is not valid.
	 */
	public function Compile( $xpath )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Creates an attribute node on the current element node using the namespace prefix,
	 * local name and namespace URI specified with the value specified.
	 *
	 * @param string $prefix The namespace prefix of the new attribute node (if any).
	 * @param string $localName The local name of the new attribute node which cannot Empty or null.
	 * @param string $namespaceURI The namespace URI for the new attribute node (if any).
	 * @param string $value The value of the new attribute node. If Empty or null are passed, an empty attribute node is created.
	 *
	 * @return void
	 *
	 * @throws
	 *   InvalidOperationException The XPathNavigator is not positioned on an element node.
	 *   NotSupportedException The XPathNavigator does not support editing.
	 */
	public function CreateAttribute( $prefix, $localName, $namespaceURI, $value )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Returns an XmlWriter object used to create new attributes on the current element.
	 *
	 * @return XmlWriter An XmlWriter object used to create new attributes on the current element.
	 *
	 * @throws
	 *   InvalidOperationException The XPathNavigator is not positioned on an element node.
	 *   NotSupportedException The XPathNavigator does not support editing.
	 */
	public function CreateAttributes()
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Returns a copy of the XPathNavigator.
	 *
	 * @return XPathNavigator An XPathNavigator copy of this XPathNavigator.
	 */
	public function CreateNavigator()
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Deletes a range of sibling nodes from the current node to the node specified.
	 *
	 * @param XPathNavigator $lastSiblingToDelete  An XPathNavigator positioned on the last sibling node in the range to delete.
	 *
	 * @return void
	 *
	 * @throws
	 *   ArgumentNullException The XPathNavigator specified is null.
	 *   NotSupportedException The XPathNavigator does not support editing.
	 *   InvalidOperationException The last node to delete specified is not a valid sibling node of the current node.
	 */
	public function DeleteRange( $lastSiblingToDelete )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Deletes the current node and its child nodes.
	 *
	 * @return void
	 *
	 * @throws
	 *   InvalidOperationException The XPathNavigator is positioned on a node that cannot be deleted such as the root node or a namespace node.
	 *   NotSupportedException The XPathNavigator does not support editing.
	 */
	public function DeleteSelf()
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Evaluates the specified XPath expression and returns the typed result.
	 *
	 * @param string $xpath  A string representing an XPath expression that can be evaluated.
	 *
	 * @return object	The result of the expression (Boolean, number, string, or node set). This maps
	 *     				to Boolean, Double, string, or XPathNodeIterator objects respectively.
	 *
	 * @throws
	 *   ArgumentException The return type of the XPath expression is a node set.
	 *   XPathException The XPath expression is not valid.
	 */
	public function EvaluateXPath( $xpath )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Evaluates the XPathExpression and returns the typed result.
	 *
	 * @param XPathExpression $expr An that can be evaluated.
	 *
	 * @return object The result of the expression (Boolean, number, string, or node set). This maps
	 *     			  to Boolean, Double, string, or XPathNodeIterator objects respectively.
	 *
	 * @throws
	 *   ArgumentException The return type of the XPath expression is a node set.
	 *   XPathException The XPath expression is not valid.
	 */
	public function EvaluateExpression( $expr )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Evaluates the specified XPath expression and returns the typed result, using the
	 * IXmlNamespaceResolver object specified to resolve namespace prefixes in the XPath expression.
	 *
	 * @param string $xpath  A string representing an XPath expression that can be evaluated.
	 * @param IXmlNamespaceResolver resolver  The IXmlNamespaceResolver object used to resolve namespace prefixes in the XPath expression.
	 *
	 * @return object The result of the expression (Boolean, number, string, or node set). This maps
	 *    			  to Boolean, Double, string, or XPathNodeIterator objects respectively.
	 *
	 * @throws
	 *   ArgumentException The return type of the XPath expression is a node set.
	 *   XPathException The XPath expression is not valid.
	 */
	public function EvaluateXPathWithResolver( $xpath, $resolver)
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Uses the supplied context to evaluate the XPathExpression, and
	 * returns the typed result.
	 *
	 * @param XPathExpression $expr  An XPathExpression that can be evaluated.
	 * @param XPathNodeIterator $context  	An XPathNodeIterator that points to the selected node set that
	 *     									the evaluation is to be performed on.
	 *
	 * @return object The result of the expression (Boolean, number, string, or node set). This maps
	 *     			  to Boolean, Double, string, or XPathNodeIterator objects respectively.
	 *
	 * @throws
	 *   ArgumentException The return type of the XPath expression is a node set.
	 *   XPathException The XPath expression is not valid.
	 */
	public function EvaluateExpressionWithResolver( $expr, $context )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Gets the value of the attribute with the specified local name and namespace URI.
	 *
	 * @param string $localName  The local name of the attribute.
	 * @param string $namespaceURI  The namespace URI of the attribute.
	 *
	 * @return string A string that contains the value of the specified attribute; Empty
	 *     			  if a matching attribute is not found, or if the XPathNavigator
	 *     			  is not positioned on an element node.
	 */
	public function GetAttribute( $localName, $namespaceURI )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Returns the value of the namespace node corresponding to the specified local
	 * name.
	 *
	 * @param string $name  The local name of the namespace node.
	 *
	 * @return string A string that contains the value of the namespace node; Empty
	 *     			  if a matching namespace node is not found, or if the XPathNavigator
	 *    			  is not positioned on an element node.
	 */
	public function GetNamespace( $name )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Returns the in-scope namespaces of the current node.
	 *
	 * @param XmlNamespaceScope $scope  IDictionary<string, string> An XmlNamespaceScope value specifying the namespaces to return.
	 *
	 * @return array An array of namespace names keyed by prefix.
	 */
	public function GetNamespacesInScope( $scope )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Creates a new sibling node after the currently selected node using the XML contents
	 * of the XmlReader object specified.
	 *
	 * @param null|XmlReader|XPathNavigator|string $newSibling  An XmlReader object positioned on the
	 * @return void
	 * @throws
	 *		ArgumentException The XmlReader object is in an error state or closed.
	 *		ArgumentNullException The XmlReader object parameter is null.
	 * 		InvalidOperationException The position of the XPathNavigator does not allow a new sibling node to be inserted after the current node.
	 *		NotSupportedException The XPathNavigator does not support editing.
	 *		XmlException The XML contents of the XmlReader object parameter is not well-formed.
	 */
	public function InsertAfter( $newSibling)
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Creates a new sibling node before the currently selected node using the nodes
	 * in the XPathNavigator specified.
	 *
	 * @param null|XPathNavigator|string|XmlReader $newSibling  An XPathNavigator object positioned on the node to add as the new sibling node.
	 * @return void
	 * @throws
	 *   ArgumentNullException The XPathNavigator object parameter is null.
	 *   InvalidOperationException The position of the XPathNavigator does not allow a new sibling
	 *     							node to be inserted before the current node.
	 *   NotSupportedException The XPathNavigator does not support editing.
	 */
	public function InsertBefore( $newSibling )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Creates a new sibling element after the current node using the namespace prefix,
	 * local name and namespace URI specified, with the value specified.
	 *
	 * @param string $prefix  The namespace prefix of the new child element (if any).
	 * @param string $localName The local name of the new child element (if any).
	 * @param string $namespaceURI The namespace URI of the new child element (if any). Empty and null are equivalent.
	 * @param string $value  The value of the new child element. If Empty or null are passed, an empty element is created.
	 *
	 * @throws
	 *   InvalidOperationException:
	 *     The position of the XPathNavigator does not allow a new sibling
	 *     node to be inserted after the current node.
	 *   NotSupportedException The XPathNavigator does not support editing.
	 */
	public function InsertElementAfter( $prefix, $localName, $namespaceURI, $value )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Creates a new sibling element before the current node using the namespace prefix,
	 * local name, and namespace URI specified, with the value specified.
	 *
	 * @param string $prefix  The namespace prefix of the new child element (if any).
	 * @param string $localName  The local name of the new child element (if any).
	 * @param string $namespaceURI  The namespace URI of the new child element (if any). Empty and null are equivalent.
	 * @param string $value The value of the new child element. If Empty or null are passed,
	 *     						an empty element is created.
	 *
	 * @throws
	 *   InvalidOperationException The position of the XPathNavigator does not allow a new sibling
	 *     							node to be inserted before the current node.
	 *   NotSupportedException The XPathNavigator does not support editing.
	 */
	public function InsertElementBefore( $prefix, $localName, $namespaceURI, $value )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Determines whether the specified XPathNavigator is a descendant
	 * of the current XPathNavigator.
	 *
	 * @param \XPathNavigator $nav  The XPathNavigator to compare to this XPathNavigator.
	 *
	 * @return bool true if the specified XPathNavigator is a descendant of the current XPathNavigator; otherwise, false.
	 */
	public function IsDescendant( $nav )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Used
	 * When overridden in a derived class, determines whether the current XPathNavigator
	 * is at the same position as the specified XPathNavigator.
	 *
	 * @param XPathNavigator $other  The XPathNavigator to compare to this XPathNavigator.
	 *
	 * @return bool  true if the two XPathNavigator objects have the same position; otherwise, false.
	 */
	public abstract function IsSamePosition( $other );

	/**
	 * IsWhitespaceNode
	 * @return bool
	 */
	public abstract function IsWhitespaceNode();

	/**
	 * Not used
	 * Gets the namespace URI for the specified prefix.
	 *
	 * @param string $prefix The prefix whose namespace URI you want to resolve. To match the default namespace, pass Empty.
	 *
	 * @return	A string that contains the namespace URI assigned to the namespace prefix
	 *     		specified; null if no namespace URI is assigned to the prefix specified. The
	 *     		string returned is atomized.
	 */
	public function LookupNamespace( $prefix )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Gets the prefix declared for the specified namespace URI.
	 *
	 * @param string $namespaceURI  The namespace URI to resolve for the prefix.
	 *
	 * @return	A string that contains the namespace prefix assigned to the namespace URI specified; otherwise,
	 * 			Empty if no prefix is assigned to the namespace URI specified. The string returned is atomized.
	 */
	public function LookupPrefix( $namespaceURI )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Determines whether the current node matches the specified XPath expression.
	 *
	 * @param string|XPathExpression $xpath  The XPath expression.
	 *
	 * @return bool true if the current node matches the specified XPath expression; otherwise, false.
	 *
	 * @throws
	 *   ArgumentException The XPath expression cannot be evaluated.
	 *   XPathException The XPath expression is not valid.
	 */
	public function Matches( $xpath )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Used
	 * When overridden in a derived class, moves the XPathNavigator
	 * to the same position as the specified XPathNavigator.
	 *
	 * @param XPathNavigator $other  The XPathNavigator positioned on the node that you want to move to.
	 *
	 * @return bool true if the XPathNavigator is successful moving to the same position as the specified
	 * 				XPathNavigator; otherwise, false. If false, the position of the XPathNavigator is unchanged.
	 */
	public abstract function MoveTo( $other );

	/**
	 * Not used
	 * Moves the XPathNavigator to the attribute with the matching local name and namespace URI.
	 *
	 * @param string $localName  The local name of the attribute.
	 * @param string $namespaceURI  The namespace URI of the attribute; null for an empty namespace.
	 *
	 * @return bool Returns true if the XPathNavigator is successful moving to the attribute; otherwise, false.
	 * 				If false, the position of the XPathNavigator is unchanged.
	 */
	public function MoveToAttribute( $localName, $namespaceURI )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Used
	 * Moves the XPathNavigator to the child node of the XPathNodeType specified.
	 *
	 * @param XPathNodeType $type The XPathNodeType of the child node to move to.
	 * @return bool Returns true if the XPathNavigator is successful moving to the child node; otherwise, false.
	 *				If false, the position of the XPathNavigator is unchanged.
	 */
	public abstract function MoveToChild( $type );

	/**
	 * Not used
	 * Moves the XPathNavigator to the child node with the local name and namespace URI specified.
	 * The namespaceUri parameter is never used
	 *
	 * @param string $localName  The local name of the child node to move to.
	 * @param string $namespaceURI  The namespace URI of the child node to move to.
	 *
	 * @return bool Returns true if the XPathNavigator is successful moving to the child node; otherwise, false.
	 * 				If false, the position of the XPathNavigator is unchanged.
	 */
	public function MoveToChildbyLocalName( $localName, $namespaceURI )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Moves the XPathNavigator to the first sibling node of the current node.
	 *
	 * @return bool Returns true if the XPathNavigator is successful moving to the first sibling node of the current node;
	 * 				false if there is no first sibling, or if the XPathNavigator is currently positioned on an attribute
	 *     			node. If the XPathNavigator is already positioned on the first sibling, XPathNavigator will return true
	 *     			and will not move its position.If XPathNavigator.MoveToFirst returns false because there is no first
	 *     			sibling, or if XPathNavigator is currently positioned on an attribute, the position of the XPathNavigator
	 *     			is unchanged.
	 */
	public function MoveToFirst()
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Used
	 * When overridden in a derived class, moves the XPathNavigator to the first attribute of the current node.
	 *
	 * @return bool	Returns true if the XPathNavigator is successful moving to the first attribute of the current node;
	 * 				otherwise, false. If false, the position of the XPathNavigator is unchanged.
	 */
	public abstract function MoveToFirstAttribute();

	/**
	 * Used
	 * When overridden in a derived class, moves the XPathNavigator to the first child node of the current node.
	 *
	 * @return bool	Returns true if the XPathNavigator is successful moving to the first child node of the current node;
	 * 				otherwise, false. If false, the position of the XPathNavigator is unchanged.
	 */
	public abstract function MoveToFirstChild();

	/**
	 * Used
	 * When overridden in a derived class, moves the XPathNavigator to the first namespace node that matches the
	 * XPathNamespaceScope specified.
	 *
	 * @param XPathNamespaceScope namespaceScope  An XPathNamespaceScope value describing the namespace scope.
	 *
	 * @return bool	Returns true if the XPathNavigator is successful moving to the first namespace node; otherwise, false.
	 * 				If false, the position of the XPathNavigator is unchanged.
	 */
	public abstract function MoveToFirstNamespace( $namespaceScope = XPathNamespaceScope::Local );

	/**
	 * Used
	 * Moves the XPathNavigator to the following element of the XPathNodeType specified, to the boundary specified,
	 * in document order.
	 *
	 * @param XPathNodeType $type  The XPathNodeType of the element. The XPathNodeType cannot be XPathNodeType.Attribute or
	 * 								XPathNodeType.Namespace.
	 * @param XPathNavigator $end  (optional) The XPathNavigator object positioned on the element boundary which the current
	 * 								XPathNavigator will not move past while searching for the following element.
	 *
	 * @return bool	true if the XPathNavigator moved successfully; otherwise false.
	 */
	public abstract function MoveToFollowing( $type, $end = null );

	/**
	 * Not used
	 * Moves the XPathNavigator to the element with the local name and namespace URI specified, to the boundary specified,
	 * in document order.
	 *
	 * @param string $localName  The local name of the element.
	 * @param string $namespaceURI  The namespace URI of the element.
	 * @param XPathNavigator $end  (Optional) The XPathNavigator object positioned on the element boundary which the current
	 * 								XPathNavigator will not move past while searching for the following element.
	 *
	 * @return bool true if the XPathNavigator moved successfully; otherwise false.
	 */
	public function MoveToFollowingLocalname( $localName, $namespaceURI, $end = null )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * When overridden in a derived class, moves to the node that has an attribute of
	 * type ID whose value matches the specified string.
	 *
	 * @param string $id  A string representing the ID value of the node to which you want to move.
	 *
	 * @return bool	true if the XPathNavigator is successful moving; otherwise,
	 *     			false. If false, the position of the navigator is unchanged.
	 */
	public function MoveToId( $id )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Moves the XPathNavigator to the namespace node with the specified namespace prefix.
	 *
	 * @param string $name  The namespace prefix of the namespace node.
	 * @return bool true if the XPathNavigator is successful moving to the specified namespace;
	 * 				false if a matching namespace node was not found, or if the XPathNavigator is not positioned
	 * 				on an element node. If false, the position of the XPathNavigator is unchanged.
	 */
	public function MoveToNamespace( $name )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Used
	 * Moves the XPathNavigator to the next sibling node of the current
	 * node that matches the XPathNodeType specified.
	 *
	 * @param XPathNodeType $type  (optional) The XPathNodeType of the sibling node to move to.
	 * @return bool true if the XPathNavigator is successful moving to the next sibling node; otherwise,
	 * 				false if there are no more siblings or if the XPathNavigator is currently positioned
	 * 				on an attribute node. If false, the position of the XPathNavigator is unchanged.
	 */
	public abstract function MoveToNext( $type = XPathNodeType::All );

	/**
	 * Not used
	 * Moves the XPathNavigator to the next sibling node with the local
	 * name and namespace URI specified.
	 *
	 * @param string $localName  The local name of the next sibling node to move to.
	 * @param string $namespaceURI  The namespace URI of the next sibling node to move to.
	 *
	 * @return bool	Returns true if the XPathNavigator is successful moving to the next sibling node;
	 * 				false if there are no more siblings, or if the XPathNavigator is currently positioned
	 * 				on an attribute node. If false, the position of the XPathNavigator is unchanged.
	 */
	public function MoveToNextByLocalname( $localName, $namespaceURI )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Used
	 * When overridden in a derived class, moves the XPathNavigator
	 * to the next attribute.
	 *
	 * @return bool	Returns true if the XPathNavigator is successful moving to the next attribute;
	 * 				false if there are no more attributes. If false, the position of the XPathNavigator is unchanged.
	 */
	public abstract function MoveToNextAttribute();

	/**
	 * Used
	 * When overridden in a derived class, moves the XPathNavigator to the next namespace node matching the
	 * XPathNamespaceScope specified.
	 *
	 * @param XPathNamespaceScope $namespaceScope  (optional) An XPathNamespaceScope value describing the namespace scope.
	 * @return bool Returns true if the XPathNavigator is successful moving to the next namespace node; otherwise,
	 * 				false. If false, the position of the XPathNavigator is unchanged.
	 */
	public abstract function MoveToNextNamespace( $namespaceScope = XPathNamespaceScope::Local );

	/**
	 * Used
	 * When overridden in a derived class, moves the XPathNavigator to the parent node of the current node.
	 *
	 * @return bool	Returns true if the XPathNavigator is successful moving to the parent node of the current node; otherwise,
	 * 				false. If false, the position of the XPathNavigator is unchanged.
	 */
	public abstract function MoveToParent();

	/**
	 * Used
	 * When overridden in a derived class, moves the XPathNavigator to the previous sibling node of the current node.
	 *
	 * @return bool	Returns true if the XPathNavigator is successful moving to the previous sibling node; otherwise,
	 * 				false if there is no previous sibling node or if the XPathNavigator is currently positioned on an
	 * 				attribute node. If false, the position of the XPathNavigator is unchanged.
	 */
	public abstract function MoveToPrevious();

	/**
	 * Used
	 * Moves the XPathNavigator to the root node that the current node
	 * belongs to.
	 */
	public abstract function MoveToRoot();

	/**
	 * Used
	 * Moves the XPathNavigator to the document node that the current node
	 * belongs to.
	 */
	public abstract function MoveToDocumentElement();

	/**
	 * Not used
	 * Creates a new child node at the beginning of the list of child nodes of the current
	 * node using the XML contents of the XmlReader object specified.
	 *
	 * @param null|XmlReader|string|XPathNavigator $newChild :	An XmlReader object positioned on the XML
	 * 															data for the new child node.
	 *
	 * @throws
	 *   ArgumentException The XmlReader object is in an error state or closed.
	 *   ArgumentNullException The XmlReader object parameter is null.
	 *   InvalidOperationException The current node the XPathNavigator is positioned on does not allow a new
	 *   							child node to be prepended.
	 *   NotSupportedException The XPathNavigator does not support editing.
	 *   XmlException The XML contents of the XmlReader object parameter is not well-formed.
	 */
	public function PrependChild( $newChild )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Creates a new child element at the beginning of the list of child nodes of the current node using the namespace prefix,
	 * local name, and namespace URI specified with the value specified.
	 *
	 * @param string $prefix  The namespace prefix of the new child element (if any).
	 * @param string $localName The local name of the new child element (if any).
	 * @param string $namespaceURI  The namespace URI of the new child element (if any). Empty andmnull are equivalent.
	 * @param string $value  The value of the new child element. If Empty or null are passed, an empty element is created.
	 *
	 * @throws
	 *   InvalidOperationException The current node the XPathNavigator is positioned on does not allow a new child node to be prepended.
	 *   NotSupportedException The XPathNavigator does not support editing.
	 */
	public function PrependChildElement( $prefix, $localName, $namespaceURI, $value )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Returns an XmlReader object that contains the current node and its child nodes.
	 *
	 * @return XmlReader An XmlReader object that contains the current node and its child nodes.
	 *
	 * @throws
	 *   InvalidOperationException The XPathNavigator is not positioned on an element node or the root node.
	 */
	public function ReadSubtree()
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Replaces a range of sibling nodes from the current node to the node specified.
	 *
	 * @param XPathNavigator $lastSiblingToReplace  An XPathNavigator positioned on the last sibling node in the range to replace.
	 *
	 * @return XmlWriter An XmlWriter object used to specify the replacement range.
	 *
	 * @throws
	 *   ArgumentNullException The XPathNavigator specified is null.
	 *   NotSupportedException The XPathNavigator does not support editing.
	 *   InvalidOperationException The last node to replace specified is not a valid sibling node of the current node.
	 */
	public function ReplaceRange( $lastSiblingToReplace )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Replaces the current node with the content of the string specified.
	 *
	 * @param string|XmlReader $newNode  The XML data string for the new node.
	 *
	 * @throws
	 *   ArgumentNullException The XML string parameter is null.
	 *   InvalidOperationException The XPathNavigator is not positioned on an element, text, processing instruction, or comment node.
	 *   NotSupportedException The XPathNavigator does not support editing.
	 *   XmlException  The XML string parameter is not well-formed.
	 */
	public function ReplaceSelf( $newNode)
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Selects a node set using the specified XPath expression with the IXmlNamespaceResolver
	 * object specified to resolve namespace prefixes.
	 *
	 * @param XPathExpression|string $xpath  An XPathExpression object containing the compiled XPath query.
	 * @param IXmlNamespaceResolver $resolver (optional) The IXmlNamespaceResolver object used to resolve namespace prefixes.
	 *
	 * @return XPathNodeIterator An XPathNodeIterator that points to the selected node set.
	 *
	 * @throws
	 *   ArgumentException The XPath expression contains an error or its return type is not a node set.
	 *   XPathException The XPath expression is not valid.
	 */
	public function Select( $xpath, $resolver)
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Selects all the ancestor nodes of the current node that have the specified local
	 * name and namespace URI.
	 *
	 * @param string $name  The local name of the ancestor nodes.
	 * @param string $namespaceURI  The namespace URI of the ancestor nodes.
	 * @param bool matchSelf  To include the context node in the selection, true; otherwise, false.
	 *
	 * @return XPathNodeIterator An XPathNodeIterator that contains the selected nodes. The returned nodes are in reverse document order.
	 *
	 * @throws  ArgumentNullException null cannot be passed as a parameter.
	 */
	public function SelectAncestors( $name, $namespaceURI, $matchSelf )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Selects all the child nodes of the current node that have the local name and
	 * namespace URI specified.
	 *
	 * @param string $name  The local name of the child nodes.
	 * @param string $namespaceURI  The namespace URI of the child nodes.
	 *
	 * @return XPathNodeIterator An XPathNodeIterator that contains the selected nodes.
	 *
	 * @throws  ArgumentNullException null cannot be passed as a parameter.
	 */
	public function SelectChildrenByName( $name, $namespaceURI )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Selects all the child nodes of the current node that have the local name and
	 * namespace URI specified.
	 *
	 * @param XPathNodeType $type  The type of the child nodes to return.
	 *
	 * @return XPathNodeIterator An XPathNodeIterator that contains the selected nodes.
	 *
	 * @throws  ArgumentNullException null cannot be passed as a parameter.
	 */
	public function SelectChildrenByType( $type )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Selects all the descendant nodes of the current node with the local name and namespace URI specified.
	 *
	 * @param XPathNodeType|string $name  The local name of the descendant nodes.
	 * @param string $namespaceURI  The namespace URI of the descendant nodes.
	 * @param bool matchSelf  true to include the context node in the selection; otherwise, false.
	 *
	 * @return XPathNodeIterator An XPathNodeIterator that contains the selected nodes.
	 *
	 * @throws
	 *   ArgumentNullException:
	 *     null cannot be passed as a parameter.
	 */
	public function SelectDescendants( $name, $namespaceURI, $matchSelf )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Selects a single node in the XPathNavigator using the specified XPathExpression object.
	 *
	 * @param XPathExpression|string $expression  An XPathExpression object containing the compiled XPath query.
	 * @param IXmlNamespaceResolver resolver  (optional) The IXmlNamespaceResolver object used to resolve namespace prefixes in the XPath query.
	 *
	 * @return XPathNavigator	An XPathNavigator object that contains the first matching node for the XPath query specified;
	 * 							otherwise null if there are no query results.
	 *
	 * @throws
	 *   ArgumentException An error was encountered in the XPath query or the return type of the XPath expression is not a node.
	 *   XPathException The XPath query is not valid.
	 */
	public function SelectSingleNode( $expression, $resolver )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Sets the typed value of the current node.
	 *
	 * @param object $typedValue  The new typed value of the node.
	 *
	 * @throws
	 *   ArgumentException The XPathNavigator does not support the type of the object specified.
	 *   ArgumentNullException The value specified cannot be null.
	 *   InvalidOperationException The XPathNavigator is not positioned on an element or attribute node.
	 *   NotSupportedException The XPathNavigator does not support editing.
	 */
	public function SetTypedValue( $typedValue )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Sets the value of the current node.
	 *
	 * @param string $value  The new value of the node.
	 *
	 * @throws
	 *   ArgumentNullException The value parameter is null.
	 *   InvalidOperationException The XPathNavigator is positioned on the root node, a namespace node, or the specified value is invalid.
	 *   NotSupportedException The XPathNavigator does not support editing.
	 */
	public function SetValue( $value)
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Gets the text value of the current node.
	 *
	 * @return string A string that contains the text value of the current node.
	 */
	public function ToString()
	{
		// throw new NotSupportedException( "XPathNavigator::" );
	}

	/**
	 * Not used
	 * Streams the current node and its child nodes to the XmlWriter object
	 * specified.
	 *
	 * @param XmlWriter $writer  The XmlWriter object to stream to.
	 */
	public function WriteSubtree( $writer )
	{
		throw new NotSupportedException( "XPathNavigator::" );
	}
}
