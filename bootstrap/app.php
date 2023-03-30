<?php

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
 * Load Assets and Views
 */
(new Assets());
(new Dashboard())->create();