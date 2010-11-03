<?php
	/*      lmail.php - this file is part of Micro CMS
	 *      
	 *      Copyright 2008 Micro CMS
	 * 
	 * 	Authors:
	 * 		- Tihomir Piha <tpiha@kset.org>
	 *      
	 *      This program is free software; you can redistribute it and/or modify
	 *      it under the terms of the GNU Lesser General Public License as published by
	 *      the Free Software Foundation; either version 2 of the License, or
	 *      (at your option) any later version.
	 *      
	 *      This program is distributed in the hope that it will be useful,
	 *      but WITHOUT ANY WARRANTY; without even the implied warranty of
	 *      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 *      GNU Lesser General Public License for more details.
	 *      
	 *      You should have received a copy of the GNU Lesser General Public License
	 *      along with this program; if not, write to the Free Software
	 *      Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
	 *      MA 02110-1301, USA.
	 *
	 *      Original license: http://www.gnu.org/licenses/lgpl.html
	 */

	/* Sends mail
	 * <param> <string> to - email address to send mail to
	 * <param> <string> from_mail - mail of the person who's sending mail
	 * <param> <string> from_name - name of the person who's sending mail
	 * <param> <string> subject - mail subject
	 * <param> <string> body - mail body
	 * <return> <boolean> - true on success, else false
	 */
	function lmail_send($to, $from_mail, $from_name, $subject, $body)
	{
		$smtp_server = lconf_get("smtp_server");
		$smtp_port = lconf_get("smtp_port");

		$from_mailer = "Socketmail v2.0";
		$smtp = $smtp_server;
		$charset = "UTF-8";
		$base_message = $body;

		$base_message = str_replace(chr(13), "", $base_message);

		$base_message = str_replace("\r\n.", "\r\n..", str_replace("\n", "\r\n", stripslashes($base_message))." \r\n");

		ini_set('sendmail_from', $from_mail);

		$connect = @fsockopen ($smtp, $smtp_port, $errno, $errstr, 5);
		if (!$connect) return false;
		$rcv = fgets($connect, 1024);

		fputs($connect, "HELO 127.0.0.1\r\n");
		$rcv = fgets($connect, 1024);

		$message = $base_message;

		fputs($connect, "RSET\r\n");
		$rcv = fgets($connect, 1024);

		fputs($connect, "MAIL FROM:$from_mail\r\n");
		$rcv = fgets($connect, 1024);
		fputs($connect, "RCPT TO:$to\r\n");
		$rcv = fgets($connect, 1024);
		fputs($connect, "DATA\r\n");
		$rcv = fgets($connect, 1024);

		fputs($connect, "Subject: $subject\r\n");
		fputs($connect, "From: $from_name <$from_mail>\r\n");
		fputs($connect, "To: $to\r\n");
		fputs($connect, "X-Sender: <$from_mail>\r\n");
		fputs($connect, "Return-Path: <$from_mail>\r\n");
		fputs($connect, "Errors-To: <$from_mail>\r\n");
		fputs($connect, "Message-Id: <".md5(uniqid(rand())).".".preg_replace("/[^a-z0-9]/i", "", $from_name)."@$smtp>\r\n");
		fputs($connect, "X-Mailer: PHP - $from_mailer\r\n");
		fputs($connect, "X-Priority: 3\r\n");
		fputs($connect, "Date: ".date("r")."\r\n");
		fputs($connect, "Content-Type: text/plain; charset=$charset\r\n");
		fputs($connect, "\r\n");
		fputs($connect, $message);

		fputs($connect, "\r\n.\r\n");
		$rcv = fgets($connect, 1024);

		fputs ($connect, "QUIT\r\n");
		$rcv = fgets ($connect, 1024);
		fclose($connect);
		ini_restore('sendmail_from');

		return true;
	}
?>
