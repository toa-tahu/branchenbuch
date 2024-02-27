<?php
//=========================================
// Script	: Auktion
// File		: index.php
// Version	: 0.1
// Author	: Matthias Franke
// Email	: info@matthiasfranke.com
// Website	: http://www.matthiasfranke.com
//=========================================
// Copyright (c) 2007 Matthias Franke
//=========================================

# Bildgr��e
define('PIC_LOGO_WIDTH',260);

# Default Value Search Field
define("SEARCH_Q_DEFAULT_VALUE", 'z.B. Schmidt');
define("SEARCH_ORT_DEFAULT_VALUE", 'z.B. Frankfurt');
define("SEARCH_STR_DEFAULT_VALUE", 'z.B. Berliner Str');
define("SEARCH_PLZ_DEFAULT_VALUE", 'z.B. 60311');

# Treffer im Pager Standard
define("MAX_LIST_SEARCH_OUT", 100);

#Treffer im Pager Suchergebnisse
define("MAX_LIST_SEARCH_OUT_FRONTEND", 10);

# Help Layer Config
define("HELP_LAYER_CONFIG","WIDTH, 250, SHADOW, true, SHADOWCOLOR, '#CCCCCC', OFFSETX, 30, OFFSETY, -20, SHADOWWIDTH, 3, ABOVE, true, PADDING, 5, BGCOLOR, '#FFFFEC'");

define("PAGER_NUMBER_PAGES", 8);

# Bildgr��e in px Breite (Alt)
define('PIC_WIDTH',135); // von PIC_TYPE_DEFAULT
define('PIC_SMALL_WIDTH',90); // von PIC_TYPE_SMALL
define('PIC_XSMALL_WIDTH',70); // von PIC_TYPE_XSMALL
define('PIC_XXSMALL_WIDTH',40); // von PIC_TYPE_XXSMALL

define('PIC_MAX_SIZE',3000000); // in Byte

# Bildtype
define('PIC_TYPE_DEFAULT',1);
define('PIC_TYPE_SMALL',2);
define('PIC_TYPE_XSMALL',3);
define('PIC_TYPE_XXSMALL',4);

# Bildgr��e in px Breite
define('PIC_TYPE_1_WIDTH',135); // von PIC_TYPE_DEFAULT
define('PIC_TYPE_2_WIDTH',70); // von PIC_TYPE_SMALL
define('PIC_TYPE_3_WIDTH',70); // von PIC_TYPE_XSMALL
define('PIC_TYPE_4_WIDTH',40); // von PIC_TYPE_XXSMALL

define('PIC_TYPE_1_HIGHT',180); // von PIC_TYPE_DEFAULT
define('PIC_TYPE_2_HIGHT',120); // von PIC_TYPE_SMALL
define('PIC_TYPE_3_HIGHT',93); // von PIC_TYPE_XSMALL
define('PIC_TYPE_4_HIGHT',53); // von PIC_TYPE_XXSMALL

define('ERROR_EMAIL_EXISTS', 'Es gibt schon einen Nutzer mit dieser e-Mail Adresse');
define('ERROR_MISSING_INPUT', 'Bitte geben Sie %s ein');
define('ERROR_MISSING_PARAMETER', 'Funktion fehlt Input');
define('ERROR_AUCTION_ENDED', 'Auktion beended');
define('ERROR_AUCTION_EXCEEDS', 'Nicht genug Vorrat');

define('URL_LINK_SEARCH', 's');
define('URL_LINK_MEMBER_DETAIL', 'details');
define('URL_LINK_EINTRAG', 'e');
define('URL_LINK_EINTRAG_START', 'https://eintragen.branchenbuchdeutschland.de');
define('URL_LINK_EINTRAG_START2', 'e_oprem');
define('URL_LINK_LOGIN', 'l');
define('URL_LINK_LOST_PASS', 'lost_pass');
define('URL_LINK_HELP', 'help');
define('URL_LINK_CANCHE', 'premium');
define('URL_LINK_SALE', 'sale');
define('URL_LINK_HOMEPAGE', 'edit_page');
define('URL_LINK_SEARCH_CONTACT', 'search_contact');
define('URL_LINK_REGISTER', 'e2');
define('URL_LINK_EDIT_MEMBER', 'em');
define('URL_LINK_EDIT_MEMBER2', 'em2');
define('URL_LINK_EDIT_MEMBER3', 'em3');
define('URL_LINK_EDIT_MEMBER4', 'em4');
define('URL_LINK_EDIT_MEMBER5', 'em5');
define('URL_LINK_EDIT_MEMBER6', 'em6');
define('URL_LINK_EDIT_MEMBER_PREVIEW', 'preview');
define('URL_LINK_LOGOUT', 'logout');
define('URL_LINK_TEL', 'telefonbuch');
define('URL_LINK_REVERSE', 'reverse');
define('URL_LINK_VIEW_PAY', 'view_pay');
define('URL_LINK_PAY', 'pay');
define('URL_LINK_AGB', 'agb');
define('URL_LINK_DATENSCHUTZ', 'datenschutz');
define('URL_LINK_IMPRESSUM', 'impressum');
define('URL_LINK_CONTACT', 'contact');
define('URL_LINK_FIRMENINDEX', 'firmidx');
define('URL_LINK_EMAIL_BESTAETIGEN', 'email-bestaetigen');
define('URL_LINK_ANGEBOT', 'angebot');
define('URL_LINK_DELETE_ENTRY', 'delete_entry');

define('URL_AJAX_LINK_SEND_CONTACT', 'send_contact');

####################################
# Admin
####################################

# Admin List
define('MAX_ADMIN_LIST',40);

define('PAGE_ID_ADMIN_OVERVIEW', 1);

define('PAGE_ID_ADMIN_BRANCHE', 2);
define('SUB_PAGE_ID_ADMIN_BRANCHE_ALL', 21);

define('PAGE_ID_ADMIN_PRIVATE', 3);
define('SUB_PAGE_ID_ADMIN_PRIVATE_ALL', 31);

define('PAGE_ID_ADMIN_MAIL_TPL', 5);
define('SUB_PAGE_ID_ADMIN_MAIL_TPL_ALL', 51);

define('PAGE_ID_ADMIN_CMS', 6);
define('SUB_PAGE_ID_ADMIN_CMS_ALL', 61);
define('SUB_PAGE_ID_ADMIN_CMS_LIVE_1', 62);

define('PAGE_ID_ADMIN_AFFILI', 9);
define('SUB_PAGE_ID_ADMIN_AFFILI_ALL', 91);

define('PAGE_ID_ADMIN_PAY', 4);
define('SUB_PAGE_ID_ADMIN_PAY_ALL', 41);

define('PAGE_ID_ADMIN_USER', 10);
define('SUB_PAGE_ID_ADMIN_USER_ALL', 101);

define('PAGE_ID_ADMIN_LOGOUT', 'logout');
define('PAGE_ID_CHECK_FIELD_OPTION', 'check_field_option');
define('PAGE_ID_INSERT_FIELD_OPTION', 'insert_field_option');
define('PAGE_ID_ADMIN_PAY_VIEW', 'view_pay');


# HASH-SALTS
# NIEMALS �NDERN !!!
define("EMAIL_CONFIRM_HASH_SALT", "sK5&3d#12eQt90M-");


?>
