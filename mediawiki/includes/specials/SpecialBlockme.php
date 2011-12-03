<?php
/**
 * Implements Special:Blockme
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @ingroup SpecialPage
 */

/**
 * A special page called by proxy_check.php to block open proxies
 *
 * @ingroup SpecialPage
 */
class SpecialBlockme extends UnlistedSpecialPage {

	function __construct() {
		parent::__construct( 'Blockme' );
	}

	function execute( $par ) {
		global $wgRequest, $wgOut, $wgBlockOpenProxies, $wgProxyKey;

		$this->setHeaders();
		$this->outputHeader();

		$ip = wfGetIP();
		if( !$wgBlockOpenProxies || $wgRequest->getText( 'ip' ) != md5( $ip . $wgProxyKey ) ) {
			$wgOut->addWikiMsg( 'proxyblocker-disabled' );
			return;
		}

		$user = User::newFromName( wfMsgForContent( 'proxyblocker' ) );
		if ( !$user->isLoggedIn() ) {
			$user->addToDatabase();
		}

		$block = new Block();
		$block->setTarget( $ip );
		$block->setBlocker( $user );
		$block->mReason = wfMsg( 'proxyblockreason' );

		$block->insert();

		$wgOut->addWikiMsg( 'proxyblocksuccess' );
	}
}
