<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SocialConnect Ads Manager - Campaigns</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #4267B2;
            --secondary-color: #E9EBEE;
            --text-color: #1C1E21;
            --light-text: #65676B;
            --hover-bg: #F0F2F5;
            --border-color: #CED0D4;
            --success-color: #42B72A;
            --warning-color: #F7B928;
            --danger-color: #E41E3F;
        }
        
        body {
            background-color: var(--secondary-color);
            color: var(--text-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .logo {
            color: var(--primary-color);
            font-size: 28px;
            font-weight: bold;
        }
        
        .search-container {
            position: relative;
            width: 100%;
            max-width: 240px;
        }
        
        .search-input {
            background-color: var(--hover-bg);
            border-radius: 20px;
            padding-left: 40px;
            border: none;
        }
        
        .search-icon {
            position: absolute;
            left: 15px;
            top: 10px;
            color: var(--light-text);
        }
        
        .nav-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--hover-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 5px;
            color: var(--text-color);
        }
        
        .nav-icon:hover {
            background-color: #E4E6E9;
        }
        
        .profile-img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }
        
        .sidebar {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 20px;
            height: calc(100vh - 90px);
            position: sticky;
            top: 70px;
            overflow-y: auto;
        }
        
        .sidebar-item {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 5px;
            cursor: pointer;
            color: var(--text-color);
            text-decoration: none;
        }
        
        .sidebar-item:hover {
            background-color: var(--hover-bg);
        }
        
        .sidebar-item.active {
            background-color: rgba(66, 103, 178, 0.1);
            color: var(--primary-color);
            font-weight: 600;
        }
        
        .sidebar-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--hover-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            color: var(--primary-color);
        }
        
        .card {
            border-radius: 8px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            border: none;
            margin-bottom: 20px;
        }
        
        .card-header {
            background-color: white;
            border-bottom: 1px solid var(--border-color);
            padding: 15px 20px;
            font-weight: 600;
        }
        
        .campaign-status {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 5px;
        }
        
        .status-active {
            background-color: var(--success-color);
        }
        
        .status-paused {
            background-color: var(--warning-color);
        }
        
        .status-ended {
            background-color: var(--light-text);
        }
        
        .status-rejected {
            background-color: var(--danger-color);
        }
        
        .status-review {
            background-color: #FF9500;
        }
        
        .table th {
            font-weight: 600;
            color: var(--light-text);
            border-top: none;
        }
        
        .table td {
            vertical-align: middle;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .filter-dropdown {
            margin-right: 10px;
        }
        
        .date-range {
            display: flex;
            align-items: center;
            padding: 6px 12px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            cursor: pointer;
        }
        
        .date-range:hover {
            background-color: var(--hover-bg);
        }
        
        .progress {
            height: 6px;
            margin-top: 5px;
        }
        
        .progress-bar {
            background-color: var(--primary-color);
        }
        
        .audience-tag {
            display: inline-block;
            background-color: var(--hover-bg);
            padding: 4px 10px;
            border-radius: 20px;
            margin-right: 5px;
            margin-bottom: 5px;
            font-size: 12px;
        }
        
        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
        }
        
        .campaign-card {
            border-left: 4px solid transparent;
            transition: all 0.2s ease;
        }
        
        .campaign-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .campaign-card.active {
            border-left-color: var(--success-color);
        }
        
        .campaign-card.paused {
            border-left-color: var(--warning-color);
        }
        
        .campaign-card.ended {
            border-left-color: var(--light-text);
        }
        
        .campaign-card.rejected {
            border-left-color: var(--danger-color);
        }
        
        .campaign-card.review {
            border-left-color: #FF9500;
        }
        
        .metric-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .metric-badge.positive {
            background-color: rgba(66, 183, 42, 0.1);
            color: var(--success-color);
        }
        
        .metric-badge.negative {
            background-color: rgba(228, 30, 63, 0.1);
            color: var(--danger-color);
        }
        
        .metric-badge.neutral {
            background-color: rgba(101, 103, 107, 0.1);
            color: var(--light-text);
        }
        
        .quick-action {
            width: 32px;
            height: 32px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 5px;
            color: var(--light-text);
            background-color: transparent;
            border: none;
            cursor: pointer;
        }
        
        .quick-action:hover {
            background-color: var(--hover-bg);
            color: var(--text-color);
        }
        
        .campaign-title {
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--primary-color);
            cursor: pointer;
        }
        
        .campaign-title:hover {
            text-decoration: underline;
        }
        
        .campaign-meta {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 5px;
        }
        
        .campaign-meta-item {
            margin-right: 15px;
            font-size: 13px;
            color: var(--light-text);
        }
        
        .campaign-meta-item i {
            margin-right: 5px;
        }
        
        .campaign-objective {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 12px;
            background-color: var(--hover-bg);
            margin-right: 5px;
        }
        
        .bulk-actions {
            display: none;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 10px 15px;
            margin-bottom: 15px;
        }
        
        .bulk-actions.show {
            display: flex;
        }
        
        .tab-nav {
            display: flex;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 20px;
        }
        
        .tab-item {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 3px solid transparent;
            font-weight: 500;
        }
        
        .tab-item.active {
            border-bottom-color: var(--primary-color);
            color: var(--primary-color);
        }
        
        .tab-item:hover:not(.active) {
            border-bottom-color: var(--border-color);
        }
        
        .campaign-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .view-toggle {
            display: flex;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            overflow: hidden;
        }
        
        .view-toggle-btn {
            padding: 6px 12px;
            background-color: white;
            border: none;
            cursor: pointer;
        }
        
        .view-toggle-btn.active {
            background-color: var(--primary-color);
            color: white;
        }
        
        .view-toggle-btn:first-child {
            border-right: 1px solid var(--border-color);
        }
        
        .search-campaigns {
            position: relative;
            width: 100%;
            max-width: 300px;
        }
        
        .search-campaigns input {
            padding-left: 35px;
            border-radius: 4px;
        }
        
        .search-campaigns i {
            position: absolute;
            left: 10px;
            top: 10px;
            color: var(--light-text);
        }
        
        @media (max-width: 992px) {
            .sidebar {
                height: auto;
                position: static;
            }
            
            .campaign-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top mb-3">
        <div class="container-fluid px-4">
            <a class="navbar-brand logo" href="#">SocialConnect</a>
            
            <div class="search-container d-none d-md-block mx-auto">
                <i class="bi bi-search search-icon"></i>
                <input type="text" class="form-control search-input" placeholder="Search Ads Manager">
            </div>
            
            <div class="d-flex align-items-center ms-auto">
                <div class="nav-icon">
                    <i class="bi bi-question-circle"></i>
                </div>
                <div class="nav-icon">
                    <i class="bi bi-gear"></i>
                </div>
                <div class="nav-icon">
                    <i class="bi bi-bell"></i>
                </div>
                <img src="/placeholder.svg?height=40&width=40" class="profile-img" alt="Profile">
            </div>
        </div>
    </nav>
    
    <div class="container-fluid px-4">
        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-lg-2 col-md-3">
                <div class="sidebar">
                    <h5 class="mb-3">Ads Manager</h5>
                    <a href="ads-manager.html" class="sidebar-item">
                        <div class="sidebar-icon">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                        <span>Dashboard</span>
                    </a>
                    <a href="campaigns.html" class="sidebar-item active">
                        <div class="sidebar-icon">
                            <i class="bi bi-megaphone"></i>
                        </div>
                        <span>Campaigns</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <div class="sidebar-icon">
                            <i class="bi bi-layers"></i>
                        </div>
                        <span>Ad Sets</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <div class="sidebar-icon">
                            <i class="bi bi-image"></i>
                        </div>
                        <span>Ads</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <div class="sidebar-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <span>Audiences</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <div class="sidebar-icon">
                            <i class="bi bi-bar-chart"></i>
                        </div>
                        <span>Analytics</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <div class="sidebar-icon">
                            <i class="bi bi-credit-card"></i>
                        </div>
                        <span>Billing</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <div class="sidebar-icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <span>Reports</span>
                    </a>
                    
                    <hr>
                    
                    <h6 class="mb-2 mt-4">Account Settings</h6>
                    <a href="#" class="sidebar-item">
                        <div class="sidebar-icon">
                            <i class="bi bi-person-gear"></i>
                        </div>
                        <span>Account Overview</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <div class="sidebar-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <span>Ad Policies</span>
                    </a>
                    <a href="#" class="sidebar-item">
                        <div class="sidebar-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <span>Access Management</span>
                    </a>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-lg-10 col-md-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Campaigns</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCampaignModal">
                        <i class="bi bi-plus-lg me-2"></i>Create Campaign
                    </button>
                </div>
                
                <!-- Bulk Actions Bar (Hidden by default, shows when items are selected) -->
                <div class="bulk-actions" id="bulkActions">
                    <div class="me-3">
                        <strong>3 campaigns selected</strong>
                    </div>
                    <button class="btn btn-sm btn-outline-primary me-2">
                        <i class="bi bi-play-fill me-1"></i>Activate
                    </button>
                    <button class="btn btn-sm btn-outline-secondary me-2">
                        <i class="bi bi-pause-fill me-1"></i>Pause
                    </button>
                    <button class="btn btn-sm btn-outline-secondary me-2">
                        <i class="bi bi-files me-1"></i>Duplicate
                    </button>
                    <button class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash me-1"></i>Delete
                    </button>
                    <button class="btn btn-sm btn-link ms-auto" onclick="document.getElementById('bulkActions').classList.remove('show')">
                        Cancel
                    </button>
                </div>
                
                <!-- Tabs -->
                <div class="tab-nav">
                    <div class="tab-item active">All Campaigns (12)</div>
                    <div class="tab-item">Active (5)</div>
                    <div class="tab-item">Paused (3)</div>
                    <div class="tab-item">Completed (2)</div>
                    <div class="tab-item">In Review (1)</div>
                    <div class="tab-item">Rejected (1)</div>
                </div>
                
                <!-- Filters -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between align-items-center">
                            <div class="d-flex flex-wrap mb-3 mb-md-0">
                                <div class="dropdown filter-dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="objectiveFilter" data-bs-toggle="dropdown" aria-expanded="false">
                                        All Objectives
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="objectiveFilter">
                                        <li><a class="dropdown-item" href="#">All Objectives</a></li>
                                        <li><a class="dropdown-item" href="#">Awareness</a></li>
                                        <li><a class="dropdown-item" href="#">Consideration</a></li>
                                        <li><a class="dropdown-item" href="#">Conversion</a></li>
                                    </ul>
                                </div>
                                
                                <div class="dropdown filter-dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="budgetFilter" data-bs-toggle="dropdown" aria-expanded="false">
                                        Budget
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="budgetFilter">
                                        <li><a class="dropdown-item" href="#">All Budgets</a></li>
                                        <li><a class="dropdown-item" href="#">Under $100</a></li>
                                        <li><a class="dropdown-item" href="#">$100 - $500</a></li>
                                        <li><a class="dropdown-item" href="#">$500 - $1000</a></li>
                                        <li><a class="dropdown-item" href="#">Over $1000</a></li>
                                    </ul>
                                </div>
                                
                                <div class="date-range">
                                    <i class="bi bi-calendar3 me-2"></i>
                                    <span>Last 30 days</span>
                                    <i class="bi bi-chevron-down ms-2"></i>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <div class="search-campaigns me-3">
                                    <i class="bi bi-search"></i>
                                    <input type="text" class="form-control" placeholder="Search campaigns">
                                </div>
                                
                                <div class="view-toggle">
                                    <button class="view-toggle-btn active" id="listViewBtn">
                                        <i class="bi bi-list"></i>
                                    </button>
                                    <button class="view-toggle-btn" id="gridViewBtn">
                                        <i class="bi bi-grid"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- List View (Default) -->
                <div id="listView">
                    <!-- Campaign 1 -->
                    <div class="card campaign-card active mb-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <div class="form-check mt-1 me-2">
                                            <input class="form-check-input" type="checkbox" value="" id="campaign1Check" onclick="toggleBulkActions()">
                                        </div>
                                        <div>
                                            <div class="campaign-title">Summer Sale Promotion</div>
                                            <div class="campaign-meta">
                                                <div class="campaign-meta-item">
                                                    <i class="bi bi-calendar3"></i> Jun 15 - Jul 15, 2023
                                                </div>
                                                <div class="campaign-meta-item">
                                                    <i class="bi bi-tag"></i> Retail
                                                </div>
                                            </div>
                                            <div>
                                                <span class="campaign-status status-active"></span>
                                                <span class="me-2">Active</span>
                                                <span class="campaign-objective">Conversions</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-muted mb-1">Budget</div>
                                    <div class="fw-semibold">$1,500.00</div>
                                    <small class="text-muted">$50.00/day</small>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-muted mb-1">Results</div>
                                    <div class="fw-semibold">587 purchases</div>
                                    <span class="metric-badge positive">+12.4%</span>
                                </div>
                                <div class="col-md-2">
                                    <div class="d-flex justify-content-end">
                                        <button class="quick-action" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="quick-action" title="Duplicate">
                                            <i class="bi bi-files"></i>
                                        </button>
                                        <button class="quick-action" title="Pause">
                                            <i class="bi bi-pause-fill"></i>
                                        </button>
                                        <div class="dropdown">
                                            <button class="quick-action" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="#">View Details</a></li>
                                                <li><a class="dropdown-item" href="#">View Ad Sets</a></li>
                                                <li><a class="dropdown-item" href="#">View Ads</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Campaign 2 -->
                    <div class="card campaign-card active mb-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <div class="form-check mt-1 me-2">
                                            <input class="form-check-input" type="checkbox" value="" id="campaign2Check" onclick="toggleBulkActions()">
                                        </div>
                                        <div>
                                            <div class="campaign-title">New Product Launch</div>
                                            <div class="campaign-meta">
                                                <div class="campaign-meta-item">
                                                    <i class="bi bi-calendar3"></i> Jul 3 - Aug 3, 2023
                                                </div>
                                                <div class="campaign-meta-item">
                                                    <i class="bi bi-tag"></i> Technology
                                                </div>
                                            </div>
                                            <div>
                                                <span class="campaign-status status-active"></span>
                                                <span class="me-2">Active</span>
                                                <span class="campaign-objective">Awareness</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-muted mb-1">Budget</div>
                                    <div class="fw-semibold">$2,000.00</div>
                                    <small class="text-muted">$100.00/day</small>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-muted mb-1">Results</div>
                                    <div class="fw-semibold">425K reach</div>
                                    <span class="metric-badge positive">+18.7%</span>
                                </div>
                                <div class="col-md-2">
                                    <div class="d-flex justify-content-end">
                                        <button class="quick-action" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="quick-action" title="Duplicate">
                                            <i class="bi bi-files"></i>
                                        </button>
                                        <button class="quick-action" title="Pause">
                                            <i class="bi bi-pause-fill"></i>
                                        </button>
                                        <div class="dropdown">
                                            <button class="quick-action" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                                <li><a class="dropdown-item" href="#">View Details</a></li>
                                                <li><a class="dropdown-item" href="#">View Ad Sets</a></li>
                                                <li><a class="dropdown-item" href="#">View Ads</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Campaign 3 -->
                    <div class="card campaign-card paused mb-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <div class="form-check mt-1 me-2">
                                            <input class="form-check-input" type="checkbox" value="" id="campaign3Check" onclick="toggleBulkActions()">
                                        </div>
                                        <div>
                                            <div class="campaign-title">Website Traffic Campaign</div>
                                            <div class="campaign-meta">
                                                <div class="campaign-meta-item">
                                                    <i class="bi bi-calendar3"></i> May 22 - Jun 22, 2023
                                                </div>
                                                <div class="campaign-meta-item">
                                                    <i class="bi bi-tag"></i> E-commerce
                                                </div>
                                            </div>
                                            <div>
                                                <span class="campaign-status status-paused"></span>
                                                <span class="me-2">Paused</span>
                                                <span class="campaign-objective">Traffic</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-muted mb-1">Budget</div>
                                    <div class="fw-semibold">$800.00</div>
                                    <small class="text-muted">$40.00/day</small>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-muted mb-1">Results</div>
                                    <div class="fw-semibold">12,450 clicks</div>
                                    <span class="metric-badge negative">-2.3%</span>
                                </div>
                                <div class="col-md-2">
                                    <div class="d-flex justify-content-end">
                                        <button class="quick-action" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="quick-action" title="Duplicate">
                                            <i class="bi bi-files"></i>
                                        </button>
                                        <button class="quick-action" title="Resume">
                                            <i class="bi bi-play-fill"></i>
                                        </button>
                                        <div class="dropdown">
                                            <button class="quick-action" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton3">
                                                <li><a class="dropdown-item" href="#">View Details</a></li>
                                                <li><a class="dropdown-item" href="#">View Ad Sets</a></li>
                                                <li><a class="dropdown-item" href="#">View Ads</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Campaign 4 -->
                    <div class="card campaign-card active mb-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <div class="form-check mt-1 me-2">
                                            <input class="form-check-input" type="checkbox" value="" id="campaign4Check" onclick="toggleBulkActions()">
                                        </div>
                                        <div>
                                            <div class="campaign-title">App Install Campaign</div>
                                            <div class="campaign-meta">
                                                <div class="campaign-meta-item">
                                                    <i class="bi bi-calendar3"></i> Jul 10 - Aug 10, 2023
                                                </div>
                                                <div class="campaign-meta-item">
                                                    <i class="bi bi-tag"></i> Mobile Apps
                                                </div>
                                            </div>
                                            <div>
                                                <span class="campaign-status status-active"></span>
                                                <span class="me-2">Active</span>
                                                <span class="campaign-objective">App Installs</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-muted mb-1">Budget</div>
                                    <div class="fw-semibold">$1,200.00</div>
                                    <small class="text-muted">$60.00/day</small>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-muted mb-1">Results</div>
                                    <div class="fw-semibold">3,245 installs</div>
                                    <span class="metric-badge positive">+8.1%</span>
                                </div>
                                <div class="col-md-2">
                                    <div class="d-flex justify-content-end">
                                        <button class="quick-action" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="quick-action" title="Duplicate">
                                            <i class="bi bi-files"></i>
                                        </button>
                                        <button class="quick-action" title="Pause">
                                            <i class="bi bi-pause-fill"></i>
                                        </button>
                                        <div class="dropdown">
                                            <button class="quick-action" type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton4">
                                                <li><a class="dropdown-item" href="#">View Details</a></li>
                                                <li><a class="dropdown-item" href="#">View Ad Sets</a></li>
                                                <li><a class="dropdown-item" href="#">View Ads</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Campaign 5 -->
                    <div class="card campaign-card ended mb-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <div class="form-check mt-1 me-2">
                                            <input class="form-check-input" type="checkbox" value="" id="campaign5Check" onclick="toggleBulkActions()">
                                        </div>
                                        <div>
                                            <div class="campaign-title">Lead Generation</div>
                                            <div class="campaign-meta">
                                                <div class="campaign-meta-item">
                                                    <i class="bi bi-calendar3"></i> Jun 28 - Jul 28, 2023
                                                </div>
                                                <div class="campaign-meta-item">
                                                    <i class="bi bi-tag"></i> B2B
                                                </div>
                                            </div>
                                            <div>
                                                <span class="campaign-status status-ended"></span>
                                                <span class="me-2">Completed</span>
                                                <span class="campaign-objective">Lead Generation</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-muted mb-1">Budget</div>
                                    <div class="fw-semibold">$500.00</div>
                                    <small class="text-muted">$25.00/day</small>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-muted mb-1">Results</div>
                                    <div class="fw-semibold">187 leads</div>
                                    <span class="metric-badge positive">+5.2%</span>
                                </div>
                                <div class="col-md-2">
                                    <div class="d-flex justify-content-end">
                                        <button class="quick-action" title="View Report">
                                            <i class="bi bi-file-earmark-text"></i>
                                        </button>
                                        <button class="quick-action" title="Duplicate">
                                            <i class="bi bi-files"></i>
                                        </button>
                                        <div class="dropdown">
                                            <button class="quick-action" type="button" id="dropdownMenuButton5" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton5">
                                                <li><a class="dropdown-item" href="#">View Details</a></li>
                                                <li><a class="dropdown-item" href="#">View Ad Sets</a></li>
                                                <li><a class="dropdown-item" href="#">View Ads</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Campaign 6 -->
                    <div class="card campaign-card review mb-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <div class="form-check mt-1 me-2">
                                            <input class="form-check-input" type="checkbox" value="" id="campaign6Check" onclick="toggleBulkActions()">
                                        </div>
                                        <div>
                                            <div class="campaign-title">Holiday Special Promotion</div>
                                            <div class="campaign-meta">
                                                <div class="campaign-meta-item">
                                                    <i class="bi bi-calendar3"></i> Aug 1 - Aug 31, 2023
                                                </div>
                                                <div class="campaign-meta-item">
                                                    <i class="bi bi-tag"></i> Retail
                                                </div>
                                            </div>
                                            <div>
                                                <span class="campaign-status status-review"></span>
                                                <span class="me-2">In Review</span>
                                                <span class="campaign-objective">Conversions</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-muted mb-1">Budget</div>
                                    <div class="fw-semibold">$1,800.00</div>
                                    <small class="text-muted">$60.00/day</small>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-muted mb-1">Status</div>
                                    <div class="fw-semibold">Pending Review</div>
                                    <small class="text-muted">Submitted 2h ago</small>
                                </div>
                                <div class="col-md-2">
                                    <div class="d-flex justify-content-end">
                                        <button class="quick-action" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="quick-action" title="Cancel Review">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                        <div class="dropdown">
                                            <button class="quick-action" type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton6">
                                                <li><a class="dropdown-item" href="#">View Details</a></li>
                                                <li><a class="dropdown-item" href="#">View Ad Sets</a></li>
                                                <li><a class="dropdown-item" href="#">View Ads</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div>Showing 6 of 12 campaigns</div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                
                <!-- Grid View (Hidden by default) -->
                <div id="gridView" class="campaign-grid" style="display: none;">
                    <!-- Grid Campaign 1 -->
                    <div class="card campaign-card active">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="campaign-status status-active"></span>
                                    <span>Active</span>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="gridCampaign1Check" onclick="toggleBulkActions()">
                                </div>
                            </div>
                            <h5 class="campaign-title">Summer Sale Promotion</h5>
                            <div class="campaign-meta mb-3">
                                <div class="campaign-meta-item">
                                    <i class="bi bi-calendar3"></i> Jun 15 - Jul 15, 2023
                                </div>
                                <div class="campaign-meta-item">
                                    <i class="bi bi-tag"></i> Retail
                                </div>
                            </div>
                            <div class="campaign-objective mb-3">Conversions</div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="text-muted">Budget</div>
                                    <div class="fw-semibold">$1,500.00</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted">Results</div>
                                    <div class="fw-semibold">587 purchases</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="metric-badge positive">+12.4%</span>
                                <div>
                                    <button class="btn btn-sm btn-outline-primary me-1">Edit</button>
                                    <button class="btn btn-sm btn-outline-secondary">Pause</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Grid Campaign 2 -->
                    <div class="card campaign-card active">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="campaign-status status-active"></span>
                                    <span>Active</span>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="gridCampaign2Check" onclick="toggleBulkActions()">
                                </div>
                            </div>
                            <h5 class="campaign-title">New Product Launch</h5>
                            <div class="campaign-meta mb-3">
                                <div class="campaign-meta-item">
                                    <i class="bi bi-calendar3"></i> Jul 3 - Aug 3, 2023
                                </div>
                                <div class="campaign-meta-item">
                                    <i class="bi bi-tag"></i> Technology
                                </div>
                            </div>
                            <div class="campaign-objective mb-3">Awareness</div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="text-muted">Budget</div>
                                    <div class="fw-semibold">$2,000.00</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted">Results</div>
                                    <div class="fw-semibold">425K reach</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="metric-badge positive">+18.7%</span>
                                <div>
                                    <button class="btn btn-sm btn-outline-primary me-1">Edit</button>
                                    <button class="btn btn-sm btn-outline-secondary">Pause</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Grid Campaign 3 -->
                    <div class="card campaign-card paused">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="campaign-status status-paused"></span>
                                    <span>Paused</span>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="gridCampaign3Check" onclick="toggleBulkActions()">
                                </div>
                            </div>
                            <h5 class="campaign-title">Website Traffic Campaign</h5>
                            <div class="campaign-meta mb-3">
                                <div class="campaign-meta-item">
                                    <i class="bi bi-calendar3"></i> May 22 - Jun 22, 2023
                                </div>
                                <div class="campaign-meta-item">
                                    <i class="bi bi-tag"></i> E-commerce
                                </div>
                            </div>
                            <div class="campaign-objective mb-3">Traffic</div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="text-muted">Budget</div>
                                    <div class="fw-semibold">$800.00</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted">Results</div>
                                    <div class="fw-semibold">12,450 clicks</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="metric-badge negative">-2.3%</span>
                                <div>
                                    <button class="btn btn-sm btn-outline-primary me-1">Edit</button>
                                    <button class="btn btn-sm btn-outline-success">Resume</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Grid Campaign 4 -->
                    <div class="card campaign-card active">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <div>
                                    <span class="campaign-status status-active"></span>
                                    <span>Active</span>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="gridCampaign4Check" onclick="toggleBulkActions()">
                                </div>
                            </div>
                            <h5 class="campaign-title">App Install Campaign</h5>
                            <div class="campaign-meta mb-3">
                                <div class="campaign-meta-item">
                                    <i class="bi bi-calendar3"></i> Jul 10 - Aug 10, 2023
                                </div>
                                <div class="campaign-meta-item">
                                    <i class="bi bi-tag"></i> Mobile Apps
                                </div>
                            </div>
                            <div class="campaign-objective mb-3">App Installs</div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="text-muted">Budget</div>
                                    <div class="fw-semibold">$1,200.00</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted">Results</div>
                                    <div class="fw-semibold">3,245 installs</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="metric-badge positive">+8.1%</span>
                                <div>
                                    <button class="btn btn-sm btn-outline-primary me-1">Edit</button>
                                    <button class="btn btn-sm btn-outline-secondary">Pause</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Create Campaign Modal -->
    <div class="modal fade" id="createCampaignModal" tabindex="-1" aria-labelledby="createCampaignModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCampaignModalLabel">Create New Campaign</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <h6>1. Campaign Objective</h6>
                        <p class="text-muted">Choose the main goal of your advertising campaign</p>
                        
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="campaignObjective" id="awarenessObjective" checked>
                                            <label class="form-check-label fw-bold" for="awarenessObjective">
                                                Awareness
                                            </label>
                                        </div>
                                        <p class="text-muted small mt-2">Increase awareness of your brand, product, or service.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="campaignObjective" id="considerationObjective">
                                            <label class="form-check-label fw-bold" for="considerationObjective">
                                                Consideration
                                            </label>
                                        </div>
                                        <p class="text-muted small mt-2">Get people to consider your products or services.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="campaignObjective" id="conversionObjective">
                                            <label class="form-check-label fw-bold" for="conversionObjective">
                                                Conversion
                                            </label>
                                        </div>
                                        <p class="text-muted small mt-2">Encourage people to take specific actions on your business.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h6>2. Campaign Details</h6>
                        <div class="mb-3">
                            <label for="campaignName" class="form-label">Campaign Name</label>
                            <input type="text" class="form-control" id="campaignName" placeholder="Enter campaign name">
                        </div>
                        <div class="mb-3">
                            <label for="campaignCategory" class="form-label">Campaign Category</label>
                            <select class="form-select" id="campaignCategory">
                                <option selected>Select a category</option>
                                <option value="retail">Retail</option>
                                <option value="ecommerce">E-commerce</option>
                                <option value="technology">Technology</option>
                                <option value="b2b">B2B</option>
                                <option value="mobile">Mobile Apps</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="startDate" class="form-label">Start Date</label>
                                    <input type="date" class="form-control" id="startDate">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="endDate" class="form-label">End Date</label>
                                    <input type="date" class="form-control" id="endDate">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <h6>3. Budget & Schedule</h6>
                        <div class="mb-3">
                            <label class="form-label">Budget Type</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="budgetType" id="dailyBudget" checked>
                                <label class="form-check-label" for="dailyBudget">
                                    Daily Budget
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="budgetType" id="lifetimeBudget">
                                <label class="form-check-label" for="lifetimeBudget">
                                    Lifetime Budget
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="budgetAmount" class="form-label">Budget Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="budgetAmount" placeholder="50.00">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-outline-primary">Save as Draft</button>
                    <button type="button" class="btn btn-primary">Continue to Ad Set</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Toggle between list and grid views
        document.getElementById('listViewBtn').addEventListener('click', function() {
            document.getElementById('listView').style.display = 'block';
            document.getElementById('gridView').style.display = 'none';
            this.classList.add('active');
            document.getElementById('gridViewBtn').classList.remove('active');
        });
        
        document.getElementById('gridViewBtn').addEventListener('click', function() {
            document.getElementById('listView').style.display = 'none';
            document.getElementById('gridView').style.display = 'grid';
            this.classList.add('active');
            document.getElementById('listViewBtn').classList.remove('active');
        });
        
        // Toggle bulk actions bar
        function toggleBulkActions() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            let checkedCount = 0;
            
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    checkedCount++;
                }
            });
            
            if (checkedCount > 0) {
                document.getElementById('bulkActions').classList.add('show');
            } else {
                document.getElementById('bulkActions').classList.remove('show');
            }
        }
    </script>
</body>
</html>