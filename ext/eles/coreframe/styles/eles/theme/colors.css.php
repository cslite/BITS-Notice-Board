<?php
ob_start('ob_gzhandler'); header('Content-type: text/css; charset: UTF-8'); header('Cache-Control: must-revalidate'); $spa33649 = 60 * 60 * 24; $sp004d19 = 'Expires: ' . gmdate('D, d M Y H:i:s', time() + $spa33649) . ' GMT'; header($sp004d19); $sp7a0028 = __DIR__ . '/../../../inc/scssphp/scss.inc.php'; require_once $sp7a0028; use Leafo\ScssPhp\Compiler; if (isset($_REQUEST)) { if (isset($_REQUEST['primary']) && isset($_REQUEST['accent']) && isset($_REQUEST['text']) && isset($_REQUEST['textalt']) && isset($_REQUEST['border']) && isset($_REQUEST['white']) && isset($_REQUEST['black'])) { $sp6111ef = new Compiler(); $sp6111ef->setFormatter('scss_formatter_compressed'); $spa27c21 = filter_input(INPUT_GET, 'theme', FILTER_SANITIZE_STRING); $spc9e503 = filter_input(INPUT_GET, 'primary', FILTER_SANITIZE_STRING); $sp288e41 = filter_input(INPUT_GET, 'accent', FILTER_SANITIZE_STRING); $sp0ceaa4 = filter_input(INPUT_GET, 'text', FILTER_SANITIZE_STRING); $sp7d25d0 = filter_input(INPUT_GET, 'textalt', FILTER_SANITIZE_STRING); $spc7b7c5 = filter_input(INPUT_GET, 'border', FILTER_SANITIZE_STRING); $speed7f3 = filter_input(INPUT_GET, 'white', FILTER_SANITIZE_STRING); $sp02df70 = filter_input(INPUT_GET, 'black', FILTER_SANITIZE_STRING); $sp103e61 = "\r\n  \$primary-c:   {$spc9e503};\r\n\r\n  \$primary-c-l: lighten( \$primary-c, 5% );\r\n  \$primary-c-d: darken( \$primary-c, 5% );\r\n  \$primary-c-z: darken( \$primary-c, 10% );\r\n\r\n  \$accent-c:    {$sp288e41};\r\n\r\n  \$accent-c-l:  lighten( \$accent-c, 5% );\r\n  \$accent-c-d:  darken( \$accent-c, 5% );\r\n\r\n  \$white:       {$speed7f3};\r\n\r\n  \$white-1:     darken( \$white, 2% );\r\n  \$white-2:     darken( \$white, 5% );\r\n  \$white-3:     darken( \$white, 7.5% );\r\n\r\n  \$black:       {$sp02df70};\r\n\r\n  \$border-c:    {$spc7b7c5};\r\n\r\n  \$border-c-l:  lighten( \$border-c, 6.5% );\r\n  \$border-c-d:  transparentize( \$border-c, .25 );\r\n  \$border-c-x:  darken( \$border-c-d, 6.5% );\r\n\r\n  \$text:        {$sp0ceaa4};\r\n\r\n  \$text-dull:     transparentize(\$text, .2);\r\n  \$text-duller:   transparentize(\$text, .5);\r\n  \$text-header: {$sp7d25d0};\r\n  \$text-footer: lighten( \$text, 50% );\r\n\r\n  \$link:        \$text;\r\n  \$link-hover:  \$primary-c;\r\n\r\n  // Contextual Colors\r\n  \$footer:      darken(desaturate(adjust-hue( \$primary-c, -20deg), 90%), 37.5%);\r\n  \$footer-alt:  darken( \$footer, 5% );\r\n  \$topbar-c:    darken(desaturate( \$primary-c, 25% ), 5%);;\r\n  \$tabs-active: lighten( \$black, 26.5% );\r\n  \$tabs-alt:    \$white-3;\r\n  \$input:       \$white;\r\n  \$input-alt:   \$white-2;\r\n  \$post-btns:     transparent;\r\n  \$post-btns-alt: \$white-2;\r\n\r\n  // Media queries breakpoints\r\n  \$screen-xs:     480px;  // phone\r\n  \$screen-sm:     768px;\r\n  \$screen-md-min: 992px;  // desktop\r\n  \$screen-lg-min: 1200px; // wide desktop\r\n\r\n  \$screen-sm-max: (\$screen-md-min - 1);\r\n  \$screen-md-max: (\$screen-lg-min - 1);\r\n"; if ('dark' === $spa27c21) { $sp103e61 .= '
  // Color vars
  $white-1:     lighten( $white, 2% );
  $white-2:     lighten( $white, 5% );
  $white-3:     lighten( $white, 7.5% );
  $border-c-l:  lighten( $border-c, 2.5% );
  $border-c-d:  $border-c;
  $border-c-x:  lighten( $border-c-d, 6.5% );
  $text-dull:   darken(  $text, 15% );
  $text-footer: darken(  $text, 15% );
  $footer:      darken(  $white, 5% );
  $footer-alt:  darken(  $footer, 5% );
  $topbar-c:    rgba(    $primary-c-z, .9 );
  $tabs-active: lighten( $black, 55% );
  $tabs-alt:    $white-3;
  $input:       darken(  $white, 2% );
  $input-alt:   darken(  $white, 5% );
  $post-btns-alt: $white-2;

  $tooltip-bg:  darken( $white, 12.5% );

  // Rules
  #page-header a:hover, #page-header a:focus {
    color: inherit;
    text-shadow: 0 0 7.5px rgba(white, 0.5);             }
  .bg1, .bg2, .bg3 { background: transparent !important; }
  #topicreview {
    border-color: $border-c-x !important;
    background:   $input-alt  !important;
    .post      {  border-color: darken( $border-c, 5% );
      p.author {  border-color: darken( $border-c, 7.5% ); } } }
  #tabs .activetab > a, #tabs .activetab > a:hover, #minitabs .activetab > a,
  #minitabs .activetab > a:hover, #navigation #active-subsection a  {
    color: $white !important; }
  .dropdown-extended .header, .dropdown-extended .footer {
    background:   $white-3 !important;
    border-color: $border-c-l !important;  }
  div.notification_list .dropdown-contents  { border-color:$border-c-x;     }
  .dropdown .dropdown-contents, .dropdown-up .dropdown-contents, #attach-panel,
  .stat-block:not(.auth-box), .forumbg, .forabg, #options-panel, #poll-panel{
                             background:   $white-2 !important;             }
  .stat-block.auth-box form{ background:   $white-2 !important;             }
  .dropdown .pointer-inner { border-color: $white-2 transparent !important; }
  .tooltip-inner           { color:        $text-header;
                             background:   $tooltip-bg;                     }
  .tooltip.top .tooltip-arrow          { border-top-color:    $tooltip-bg;  }
  .tooltip.top-left .tooltip-arrow     { border-top-color:    $tooltip-bg;  }
  .tooltip.top-right .tooltip-arrow    { border-top-color:    $tooltip-bg;  }
  .tooltip.right .tooltip-arrow        { border-right-color:  $tooltip-bg;  }
  .tooltip.left .tooltip-arrow         { border-left-color:   $tooltip-bg;  }
  .tooltip.bottom .tooltip-arrow       { border-bottom-color: $tooltip-bg;  }
  .tooltip.bottom-left .tooltip-arrow  { border-bottom-color: $tooltip-bg;  }
  .tooltip.bottom-right .tooltip-arrow { border-bottom-color: $tooltip-bg;  }
  .tabs-mini .nav>li:not(.active)>a:hover {background: $white-1 !important; }
  #navbar-main.topbar .inner a.header-avatar {
    &:hover > span, &:focus > span     { color: $text-header !important; }  }
  #back2topMain                        { color: $text-header !important; }
  #search-box.search-header {            background: white    !important;
    .inputbox { background: transparent !important;  color: #444 !important;
      &:hover { background: darken(white, 5%)                !important; } }
    a.button, button.button {      background: transparent   !important;
                                   color: lighten(#444, 20%) !important;
      &:hover, &:active, &:focus { color: #444               !important; } } }
  .navbar.bottom                 { border-top-color: $border-c-x !important;}
  li.header                      { box-shadow: none !important;              }
  li.row dl.icon:before          { background: $white-3 !important;         }
  #darken                        { background: black !important;             }
'; } $sp103e61 .= '
  html {
    background: $footer-alt;
  }
  html.js {
    #preloader {
      background: $white;
    }
  }
  body {
    color: $text;
  }
  ::selection {
    background: rgba( $primary-c, 0.85) !important;
    color: $white !important;
  }
  ::-moz-selection {
    background: rgba( $primary-c, 0.85) !important;
    color: $white !important;
  }
  h2 {
    &.memberlist-title {
      border-bottom-color: $border-c;
    }
  }
  hr {
    border-top-color: $border-c;
  }
  #wrap {
    background: $white-1;
  }
  #page-header {
    background: $primary-c;
    background: linear-gradient(110deg, $primary-c 0%, $accent-c 100%);
    color: $text-header;
    a {
      color: inherit;
    }
  }
  #page-body-wrapper {
    &.leftside,
    &.rightside {
      border-color: $border-c;
    }
  }
  #page-sidebar {
     border-color: $border-c;
    .widget-title {
      &::before {
        background: $primary-c-l;
      }
      &::after {
        background: $border-c;
      }
    }
  }
  #page-footer {
    background: $footer;
    color: $text-footer;
    a {
      color: $text-footer;
      &:hover,
      &:focus {
        color: $primary-c-l;
      }
    }
    .dropdown a {
      &:hover,
      &:focus {
        color: $primary-c;
      }
    }
  }
  .top-block {
    border-bottom-color: $border-c;
  }
  .bottom-block {
    border-top-color: $border-c;
  }
  #navbar-main {
    &.fixed {
      background: rgba( $topbar-c, .975 );
    }
  }
  .topbar {
    .inner {
      color: $text-header;
      a.header-avatar {
        &:hover > span, &:focus > span {
          color: $white !important;
          text-shadow: none;
        }
      }
      > ul > li > a {
        &:hover,
        &:focus {
          color: $white;
          text-shadow: none;
        }
      }
    }
    .dropdown a:hover {
      text-shadow: none !important;
      color: $link-hover !important;
    }
  }
  .endbar {
    background: $footer-alt;
    color: darken( $text-footer, 15% );
    a {
      color: inherit !important;
    }
  }
  .navbar {
    &.top .inner {
      background: $white-1;
      border-color: $border-c;
      color: $text;
    }
    &.bottom .inner.container {
      background: $white-1;
      border-color: $border-c;
      color: $text;
    }
  }
  .forabg, .forumbg, #options-panel, #attach-panel, #poll-panel {
    border-color: $border-c;
    background: $white;
  }
  #confirm > .panel, #message.panel {
    background: $white;
  }
  .post {
    border-color: $border-c-l;
    .back2top {
      a.top {
        color: $border-c;
      }
    }
  }
  #postingbox {
    border-color: $border-c;
  }
  #preview.post {
    border-color: $border-c;
  }
  ul.social-links {
    li {
      a {
        box-shadow: inset 0 0 0 1px rgba($primary-c-l, .05);
        color: $text-dull;
        &:hover,
        &:focus {
          box-shadow: inset 0 0 0 1px rgba($primary-c-l, .5);
          color: $primary-c-l;
        }
      }
    }
  }
  .dropdown li.separator {
    border-top-color: $border-c-l;
  }
  .breadcrumbs .crumb:before {
    color: rgba($text, .25);
    .bottom & {
      color: rgba($text, .25);
    }
  }
  .breadcrumbs .crumb a {
    &:hover,
    &:focus {
      color: $primary-c-l;
    }
    .navbar.top & {
      &:hover,
      &:focus {
        box-shadow: 0 6px 0 0 $primary-c-l;
      }
    }
  }

  .navbar.top .breadcrumbs .crumb:last-child a {
    box-shadow: 0 6px 0 0 $primary-c-l;
  }

  table.table1 thead th {
    background: $white-2;
  }
  table.table1 tbody tr {
    border-color: $border-c-l;
    &:hover,
    &.hover {
      background: $white-1;
      color: $black;
    }
  }
  table.table1 tbody th {
    color: $text;
    background: $white;
  }
  table.info tbody th {
    color: $text;
  }
  .action-bar.top {
    border-top-color: $border-c;
  }
  .action-bar.bottom {
    border-bottom-color: $border-c;
  }

  .pagination li a, .pagination li span {
    background: $primary-c;
    color: $text-header;
  }
  .pagination li a:hover {
    background: $primary-c-l;
  }
  .pagination li.ellipsis span {
    color:  $text;
  }
  .phpbb_alert {
    background: $white;
    border-color: $border-c-x;
  }
  .phpbb_alert .alert_close {
    color: $text;
    &:hover {
      color: darkred;
    }
  }
  p.post-notice {
    border-left-color: $accent-c;
  }
  .stats-blocks {
    .col-block {
      + .col-block {
        border-left-color: $border-c-l;
      }
    }
  }
  .stat-block:not(.auth-box),
  .stat-block.auth-box form {
    background: $white;
    border-color: $border-c;
  }
  .notification_list p.notification-time {
    color: $primary-c-d;
  }
  .profile-inner {
    .col {
      border-top-color: $border-c;
    }
    .panel.bottom {
      border-bottom-color: $border-c;    
    }
  }
  a {
    color: $link;
    &:hover,
    &:focus,
    &:active {
      color: $link-hover;
    }
  }
  .postlink {
    color: $primary-c;
    &:hover {
      border-bottom-color: $border-c-d;
    }
  }
  a.feed-icon-forum {
    li.row:hover & {
      &:hover {
        background: $primary-c;
      }
    }
  }
  ul.forums, ul.topics {
    .time {
      color: $text-dull;
    }
  }
  ul.topiclist li.row dt a.subforum {
    &.read:before, &.unread:before {
      border-top-color: $border-c;
    }
    &.unread:before {
      border-color: $primary-c;
    }
  }
  li.row {
    border-top-color: $border-c-l;
    &:hover {
      background: $white-1 !important;
    }
  }
  li.row strong {
    &.subforums-title {
      color: $black;
    }
  }
  li.row .subforums-wrapper {
    border-left-color: $border-c;
  }
  li.header {
    background: $primary-c;
    color: $text-header;
  }
  dl.icon dt .list-inner {
    .responsive-hide {
      color: $text-dull;
    }
  }
  .postbody h3 {
    a {
      color: $text;
      &:hover,
      &:focus {
        color: $text;
        border-bottom-color: $border-c-d;
      }
    }
  }
  .has-profile {
    .postprofile:before,
    .postbody:after {
      border-left-color: $border-c-l;
    }
  }
  #topicreview {
    border-color: $border-c;
    background: $white-1;
  }
  .posthilit {
    background: $white-3;
    color: $accent-c;
  }
  p.author {
    border-bottom-color: $border-c-l;
  }
  .signature {
    border-top-color: $border-c-l;
    .postbody & {
      color: $text-dull;
    }
  }
  .codebox {
    border-color: $border-c;
    background: $white-2;
  }
  .codebox code {
    color: $text-dull;
    border-top-color: $border-c;
  }
  .attachbox {
    border-color: $border-c;
    background: $white-2;
  }
  dl.file dd {
    color: $text-dull;
  }
  dl.thumbnail img {
    border-color: $border-c-x;
    background: $white;
  }
  .attachbox dl.thumbnail dd {
    color: $text-dull;
  }
  dl.thumbnail dt a:hover img {
    border-color: $primary-c;
  }
  fieldset.polls dd div {
    color: $text-header;
  }
  .vote-submitted {
    color: $text-dull;
  }
  .postprofile .avatar {
    &.auto-avatar .img {
      background: $primary-c-l;
      color: white;
    }
  }
  .profile-meta {
    color: transparent;
    .post:hover & {
      color: $text-duller;
    }
  }

  .postbody .content::-webkit-scrollbar, #topicreview::-webkit-scrollbar,
  #post_details::-webkit-scrollbar, .codebox code::-webkit-scrollbar,
  .attachbox dd::-webkit-scrollbar, .attach-image::-webkit-scrollbar,
  .dropdown ul::-webkit-scrollbar, #mchat-messages::-webkit-scrollbar,
  #shoutbox_scroll::-webkit-scrollbar {
    background: transparent;
  }

  .postbody .content::-webkit-scrollbar-thumb,
  #topicreview::-webkit-scrollbar-thumb, #post_details::-webkit-scrollbar-thumb,
  .dropdown ul::-webkit-scrollbar-thumb, .codebox code::-webkit-scrollbar-thumb,
  .attachbox dd::-webkit-scrollbar-thumb,.attach-image::-webkit-scrollbar-thumb,
  #mchat-messages::-webkit-scrollbar-thumb,
  #shoutbox_scroll::-webkit-scrollbar-thumb {
    background: rgba($border-c-x, 0.6);
  }
  #back2topMain {
    background: $primary-c;
    color: $white;
    &.active {
      &:hover {
        background: $primary-c-l;
      }
    }
  }
  .contact-icons a {
    border-bottom-color: $border-c-l;
    border-right-color: $border-c-l;
  }
  .post-buttons a.icon-button {
    background: $post-btns;
    &:hover,
    &:focus {
      background: $post-btns-alt;
    }
    &:active {
      background: $post-btns-alt;
    }
  }
  .section-ucp .panel, .section-mcp .panel {
    border-color: $border-c;
  }
  .panel-container .panel li.header dd, .panel-container .panel li.header dt {
    //color: $text-header;
  }
  ul.cplist {
    border-color: $border-c;
  }
  .panel-container table.table1 thead {
    border-color: $border-c-l;
  }
  fieldset.polls dl {
    border-top-color: $border-c-l;
  }
  #tabs .tab > a {
    &:hover {
      background: $tabs-alt;
    }
  }
  #tabs .activetab > a, #tabs .activetab > a:hover {
    background: $tabs-active;
    color: $text-header;
  }
  #minitabs .tab > a:hover {
    background: $tabs-alt;
  }
  #minitabs .activetab > a, #minitabs .activetab > a:hover {
    background: $tabs-active;
    color: $text-header;
  }
  #navigation a {
    color: $text;
    &:hover {
      background: $tabs-alt;
    }
    &:hover:after {
      border-left-color: $tabs-alt;
    }
  }
  #navigation #active-subsection a {
    background: $tabs-active;
    color: $text-header;
    &:after {
      border-left-color: $tabs-active;
    }
  }
  /*
  input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0px 1000px $input inset;
    -webkit-text-fill-color: $text !important;
  }
  */
  input[type="text"], .inputbox {
    border-color: $border-c-d;
    background: $input;
    &:hover {
      background: $input-alt;
    }
  }
  input[type="checkbox"], input[type="radio"], .input-view  {
    &:before {
      border-color: $border-c-d;
    }
  }
  input[type="radio"], .input-view.type-radio {
    &:before {
      color: $input;
      background: $input;
    }
    &:checked::before, &:checked + .input-view::before {
      background: $primary-c;
    }
    &:checked:hover::before, &:checked + .input-view:hover::before {
      background: $primary-c-l;
    }
    &:hover::before {
      background: $primary-c-l;
      border-color: $primary-c;
    }
  }
  input[type="checkbox"], .input-view.type-checkbox {
    &:checked::before, &:checked + .input-view::before {
      color: $primary-c;
    }
    &:hover::before {
      color: $primary-c-l;
      border-color: $primary-c-l;
    }
    &:checked:focus::before, &:checked + .input-view:focus::before {
      color: $border-c-d;
      border-color: $border-c-d;
    }
    &:focus::before {
      color: transparent;
    }
    &:active::before {
      color: $border-c-d !important;
      border-color: $border-c-d;
    }
  }
  label {
    &[for]:hover {
      color: $primary-c;
    }
  }
  label:hover .input-view.type-checkbox::before {
    @extend .input-view.type-checkbox:hover::before;
  }
  label:hover input[type="checkbox"]:checked + .input-view::before {
    @extend input[type="checkbox"]:checked:focus::before;
  }
  label:hover .input-view.type-radio:before {
    @extend .input-view.type-radio:hover::before;
  }
  label:hover input[type="radio"]:checked + .input-view::before {
    @extend input[type="radio"]:checked:hover::before;
  }
  select {
    border-color: $border-c-d;
    background: $input;
    &:hover,
    &:focus {
      color: $text;
      border-color: $border-c-d;
    }
    &:hover {
      background: $input-alt;
    }
  }
  label {
    &[for^="icon-"] {
      input {
        &:before {
          color: $primary-c;
        }
        &:checked::before,
        &:hover::before,
        &:checked:hover::before {
          background: $input;
        }
      }
      &:hover input:before {
        background: $input-alt;
      }
    }
  }
  fieldset.display-options {
    color: $text-dull;
    select {
      background: $white;
      &:hover,
      &:focus {
        color: $text;
      }
    }
    label.go {
      &:hover {
        color: $text;
      }
    }
  }
  #format-buttons {
    input[type="button"] {
      &:hover, &:focus {
        background: $input-alt;
        color: $primary-c;
      }
    }
  }
  .inputbox:hover, .inputbox:focus {
    border-color: $border-c-d;
  }
  textarea.inputbox {
    background: $input-alt;
    &:hover,
    &:focus {
      background: $input;
    }
  }
  #qr_postform {
    background: $white-1;
    border-bottom-color: $border-c;
    textarea.inputbox {
      background: $input;
      &:hover {
        background: $input-alt;
      }
    }
  }
  .button, a.button, input.button1 {
    background-color: $primary-c;
    color: $text-header;
    &:hover {
      background-color: $primary-c-l;
    }
    &:focus,
    &:active {
      background: $primary-c-d;
    }
  }
  a.button2, input.button2 {
    background: $accent-c;
    &:hover {
      background: $accent-c-l;
    }
    &:focus,
    &:active {
      background: $accent-c-d;
    }
  }
  input.disabled {
    color: $text-dull;
  }
  .dropdown-select:after {
    border-left-color: rgba( $white, 0.3 );
  }
  .search-box .button {
    background: $input;
    color: $text;
    border-color: $border-c-d;
    &:hover {
      background: $input;
    }
  }
  .search-header {
    background: $white;
    .inputbox {
      color: $text;
    }
    a.button,
    button.button {
      color: $text-dull !important;
      &:hover,
      &:active,
      &:focus {
        color: $text !important;
      }
    }
  }
  .post:target h3 a {
    color: $primary-c;
  }
  .bg1 {
    background: $white;
  }
  .bg2 {
    background: $white;
  }
  .bg3  {
    background: $white;
  }
  table.zebra-list tr:nth-child(odd) td,
  ul.zebra-list li:nth-child(odd) {
    background: $white;
  }
  table.zebra-list tr:nth-child(even) td,
  ul.zebra-list li:nth-child(even) {
    background: $white-2;
  }
  .ucprowbg {
    background: $white-2;
  }
  .fieldsbg {
    background: $white-2;
  }
  .sep {
    color: $primary-c;
  }
  .pagination li.active span {
    background: $primary-c-l;
  }
  th a {
    color: $text-header;
    &:hover {
      color: $text-header;
    }
  }
  li.header dt, li.header dd {
  a {
      color: $text-header;
    }
    a:hover,
    a:focus {
      color: $text-header;
    }
  }
  .notice {
    border-top-color: $border-c;
  }
  blockquote {
    background: $white-1;
    border-color: $border-c;
    &:before {
      color: transparentize($text-dull, .85);
    }
  }
  blockquote cite {
    border-bottom-color: $border-c;
  }
  blockquote blockquote {
    background: $white-2;
  }
  blockquote blockquote blockquote {
    background: $white-3;
  }
  .syntaxbg       { color: $white; }
  .syntaxhtml     { color: $black; }
  .pm-message .attachbox {
    background: $white-1;
  }
  .attachbox p.stats {
    color: $text-dull;
  }
  .attach-image img {
    border-color: $border-c-x;
  }
  .pollbar1 { background: darken($accent-c-l, 20%); }
  .pollbar2 { background: darken($accent-c-l, 15%); }
  .pollbar3 { background: darken($accent-c-l, 10%); }
  .pollbar4 { background: darken($accent-c-l, 5%); }
  .pollbar5 { background: $accent-c-l; }
  .pm .postprofile {
    border-color: $border-c;
  }
  dd.profile-warnings {
    color: $accent-c;
  }
  .panel-container h3 {
    border-top-color: $border-c-l;
  }
  .panel-container .panel li.row {
    border-bottom-color: $border-c-l;
  }
  #cp-main .pm-message {
    border-color: $border-c-l;
  }
  #cp-main .post.pm {
    border-color: $border-c-l;
  }
  @media (max-width: $screen-md-min) {
    #navigation a, .rtl #navigation a { background: $white-2; }
  }
  .current {
    // empty
  }
  .pmlist li.pm_message_reported_colour, .pm_message_reported_colour {
    border-left-color: $accent-c;
    border-right-color: $accent-c;
  }
  .pmlist li.pm_marked_colour, .pm_marked_colour {
    border-color: tomato;
  }
  .pmlist li.pm_replied_colour, .pm_replied_colour {
    border-color: $border-c-l;
  }
  .pmlist li.pm_friend_colour, .pm_friend_colour {
    border-color: $primary-c;
  }
  .pmlist li.pm_foe_colour, .pm_foe_colour {
    border-color: $accent-c;
  }
  #gallery label {
    background: $white;
    border-color: $border-c;
  }
  #gallery label:hover {
    background: $white-3;
  }
  #message-box textarea.drag-n-drop {
    outline-color: rgba($border-c-x, 0.5);
  }
  #message-box textarea.drag-n-drop-highlight {
    outline-color: rgba($primary-c, 0.5);
  }
  .inputbox:-moz-placeholder {
    color: $text-dull;
  }
  .inputbox::-webkit-input-placeholder {
    color: $text-dull;
  }
  #darken {
    background: $black;
  }
  .dropdown-extended ul li {
    border-top-color: $border-c;
  }
  .dropdown-extended ul li:hover {
    //background: $white-1;
  }
  .dropdown-extended .header, .dropdown-extended .footer {
    background: $white-1;
    border-color: $border-c;
  }
  .dropdown .pointer-inner {
    border-color: $white transparent;
  }
  .dropdown-extended .pointer-inner {
    border-color: $white transparent;
  }
  .dropdown .dropdown-contents, .dropdown-up .dropdown-contents {
    background: $white;
    color: $text;
  }
  dl.icon {
    &:before {
      background: $white-2;
      color: $text;
    }
    // Unread
    &.forum_unread:before, &.forum_unread_subforum:before,
    &.forum_unread_locked:before, &.sticky_unread:before,
    &.sticky_unread_mine:before, &.sticky_unread_locked:before,
    &.sticky_unread_locked_mine:before, &.topic_unread:before,
    &.topic_unread_mine:before, &.topic_unread_locked:before,
    &.topic_unread_locked_mine:before,
    &.pm_unread:before {
      color: $primary-c;
    }
    &.topic_read_hot:before, &.topic_read_hot_mine:before,
    &.topic_unread_hot:before, &.topic_unread_hot_mine:before {
      color: $accent-c-l;
    }
    &.topic_unread_hot:before, &.topic_unread_hot_mine:before {
      color: $accent-c;
    }
    // Announcements
    &.announce_read:before, &.announce_read_locked:before {
      color: $accent-c-l;
    }
    &.announce_read_locked_mine:before, &.announce_read_mine:before {
      color: $primary-c-l;
    }
    &.announce_unread:before, &.announce_unread_locked:before {
      color: $accent-c;
    }
    &.announce_unread_mine:before {
      color: $primary-c;
    }
    &.global_read:before, &.global_read_mine:before,
    &.global_read_locked:before, &.global_read_locked_mine:before {
      color: $accent-c-l;
    }
    &.global_unread_locked:before, &.global_unread_locked_mine:before,
    &.global_unread:before, &.global_unread_mine:before {
      color: $accent-c;
    }
    &.global_read_mine:before {
      color: $primary-c-l;
    }
    &.global_unread_mine:before {
      color: $primary-c;
    }
  }

  .imageset.forum_link:before {
    color: $text-dull;
  }
  .imageset.forum_read:before {
    color: $text-dull;
  }
  .imageset.forum_read_locked:before {
    color: $text-dull;
  }
  .imageset.forum_read_subforum:before {
    color: $text-dull;
  }
  .imageset.forum_unread:before {
    color: $primary-c;
  }
  .imageset.forum_unread_locked:before {
    color: $primary-c;
  }
  .imageset.forum_unread_subforum:before {
    color: $primary-c;
  }
  .imageset.topic_moved:before {
    color: $text-dull;
  }
  .imageset.topic_read:before {
    color: $text-dull;
  }
  .imageset.topic_read_mine:before {
    color: $text-dull;
  }
  .imageset.topic_read_hot:before {
    color: $accent-c-l;
  }
  .imageset.topic_read_hot_mine:before {
    color: $accent-c-l;
  }
  .imageset.topic_read_locked:before {
    color: $text-dull;
  }
  .imageset.topic_read_locked_mine:before {
    color: $text-dull;
  }
  .imageset.topic_unread:before {
    color: $primary-c;
  }
  .imageset.topic_unread_mine:before {
    color: $primary-c;
  }
  .imageset.topic_unread_hot:before {
    color: $accent-c;
  }
  .imageset.topic_unread_hot_mine:before {
    color: $accent-c;
  }
  .imageset.topic_unread_locked:before {
    color: $primary-c;
  }
  .imageset.topic_unread_locked_mine:before {
    color: $primary-c;
  }
  .imageset.sticky_read:before {
    color: $text-dull;
  }
  .imageset.sticky_read_mine:before {
    color: $text-dull;
  }
  .imageset.sticky_read_locked:before {
    color: $text-dull;
  }
  .imageset.sticky_read_locked_mine:before {
    color: $text-dull;
  }
  .imageset.sticky_unread:before {
    color: $primary-c;
  }
  .imageset.sticky_unread_mine:before {
    color: $primary-c;
  }
  .imageset.sticky_unread_locked:before {
    color: $primary-c;
  }
  .imageset.sticky_unread_locked_mine:before {
    color: $primary-c;
  }
  .imageset.announce_read:before {
    color: $accent-c-l;
  }
  .imageset.announce_read_mine:before {
    color: $accent-c-l;
  }
  .imageset.announce_read_locked:before {
    color: $accent-c-l;
  }
  .imageset.announce_read_locked_mine:before {
    color: $accent-c-l;
  }
  .imageset.announce_unread:before {
    color: $accent-c;
  }
  .imageset.announce_unread_mine:before {
    color: $accent-c;
  }
  .imageset.announce_unread_locked:before {
    color: $accent-c;
  }
  .imageset.announce_unread_locked_mine:before {
    color: $accent-c;
  }
  .imageset.global_read:before {
    color: $accent-c-l;
  }
  .imageset.global_read_mine:before {
    color: $accent-c-l;
  }
  .imageset.global_read_locked:before {
    color: $accent-c-l;
  }
  .imageset.global_read_locked_mine:before {
    color: $accent-c-l;
  }
  .imageset.global_unread:before {
    color: $accent-c;
  }
  .imageset.global_unread_mine:before {
    color: $accent-c;
  }
  .imageset.global_unread_locked:before {
    color: $accent-c;
  }
  .imageset.global_unread_locked_mine:before {
    color: $accent-c;
  }
  .imageset.subforum_read:before {
    color: $text-dull;
  }
  .imageset.subforum_unread:before {
    color: $primary-c;
  }
  .imageset.pm_read:before {
    color: $text-dull;
  }
  .imageset.pm_unread:before {
    color: $primary-c;
  }
  .imageset.icon_post_target:before {
    color: $text-duller;
    a:hover &,
    a:focus &,
    a:active & {
      color: $text-dull;
    }

  }
  .file-progress-bar, #file-total-progress-bar {
    background: $primary-c;
  }
  .widget-infotabs {
    .nav > li > a {
      border-bottom-color: $border-c;
      &:hover {
        border-color: $border-c-l $border-c-l $border-c;
        background-color: $border-c-l;
      }
      &:focus {
        border-color: $border-c $border-c transparent !important;
      }
    }
    .nav-tabs {
      border-bottom-color: $border-c;
      > li.active > a {
        color: $text;
        border-color: $border-c $border-c transparent $border-c;
        &:hover {
          border-color: $border-c $border-c transparent !important;
        }
      }
    }
  }
  // 13.0 Extensions
  #eles #phpbb_announcement {
    background-color: $accent-c;
    color: $text-header;
  }
  #eles .aboutus {
    .content {
      border-top-color: $border-c;
      border-bottom-color: $border-c;
    }
  }
  #eles {
    #boardrules-categories {
      .mini-panel {
        border-left-color: $border-c;
      }
    }
    #rules {
      .rule-item {
        + li {
          border-top-color: $border-c;
        }
      }
      .highlight {
        background-color: $white;
        border-color: $border-c;
        border-left-color: $accent-c;
      }
    }
  }
  #eles {
    #abbc3_buttons {
      select {
        border-color: $border-c-d;
        background: $input !important;
        &:hover,
        &:focus {
          color: $text;
          border-color: $border-c-d;
        }
        &:hover {
          background: $input-alt;
        }

      }
      .abbc3_button {
        &:hover {
          border-color: $border-c-d;
          background-color: $input;
        }
      }
    }
    #bbcode_wizard {
      background: $white;
      border-color: $border-c-d;
      hr {
        border-top-color: $border-c-l;
      }
      fieldset.submit-buttons {
        border-top-color: $border-c;
      }
    }
  }
  #eles {
    .postlove {
      border-color: $border-c;
      background-color: $white-1;
    }
  }
  #eles {
    #topic_preview {
      border-color: $border-c;
      &:before {
        border-top-color: $border-c;
        border-right-color: $border-c;
      }
    }
  }
  #eles {
    #quick-login-panel {
      background: $white;
    }
  }
  #eles {
    #mchat-panel {
      border-top-color: $border-c;
      #mchat-add {
        background-color: $primary-c;
      }
      #mchat-status {
        border-top-color: $border-c;
      }
    }
  }
  #eles {
    #medals-container {
      border-top-color: $border-c;
      border-bottom-color: $border-c;
    }
  }
  #eles {
    input#text_shoutbox {
      @extend .inputbox;
    }
    #submit_shoutbox {
      background-color: $primary-c;
    }
    ul.ajaxshoutboxpost {
      li.row {
        border-bottom-color: $border-c;
      }
    }
  }

  // 14.0 Responsive Design
  @media (max-width: $screen-sm) {
    #page-sidebar {
      border-top-color: $border-c;
      .widget {
        border-color: $border-c;
      }
    }
    #eles {
      #boardrules-categories {
        .mini-panel {
          border-bottom-color: $border-c;
        }
      }
    }
  }
  // 15.0 Special Effects
  .ripple { background: $white !important; }
'; echo $sp6111ef->compile($sp103e61); } }