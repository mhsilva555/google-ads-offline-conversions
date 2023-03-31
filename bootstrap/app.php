<?php

use App\GoogleOffline\Ajax\ConversionName;
use App\GoogleOffline\Ajax\DeleteExport;
use App\GoogleOffline\Ajax\DeleteLead;
use App\GoogleOffline\Ajax\ExportLead;
use App\GoogleOffline\Assets;
use App\GoogleOffline\Dashboard;
use App\GoogleOffline\Database;
use App\GoogleOffline\Leads;

/**
 * Create Database Plugin
 */
Database::create(DATABASE);

/**
 * Crete New Lead
 */
(new Leads())->newLead();

/**
 * Ajax
 */
(new DeleteLead());
(new ExportLead());
(new ConversionName());
(new DeleteExport());

/**
 * Load Assets and Views
 */
(new Assets());
(new Dashboard())->create();