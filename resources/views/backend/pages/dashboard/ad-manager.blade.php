@extends('backend.master.main')
@section('content')
    <main id="main" class="main p-0">
        <!-- Ad Manager Content -->
        <div class="container-fluid px-0">
            <div class="row m-0 ">
                <!-- Ad Manager Dashboard Header -->
                <div class="col-12 bg-white py-3 px-4 mb-3 mt-2 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Ads Manager Dashboard</h4>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCampaignModal">
                            <i class="bi bi-plus-lg me-2"></i>Create Campaign
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Ad Manager Content -->
            <div class="row m-0">
                <div class="col-12 px-4">
                    <!-- Filters -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex py-3 flex-wrap justify-content-between align-items-center">
                                <div class="d-flex flex-wrap mb-3 mb-md-0 mx-3 gap-5">
                                    <div class="dropdown filter-dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            id="campaignFilter" data-bs-toggle="dropdown" aria-expanded="false">
                                            @if ($filters['status'] == 'all')
                                                All Campaigns
                                            @elseif($filters['status'] == 'active')
                                                Active Campaigns
                                            @elseif($filters['status'] == 'paused')
                                                Paused Campaigns
                                            @elseif($filters['status'] == 'review')
                                                In Review Campaigns
                                            @elseif($filters['status'] == 'ended')
                                                Ended Campaigns
                                            @elseif($filters['status'] == 'rejected')
                                                Rejected Campaigns
                                            @endif
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="campaignFilter">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('ad-manager.dashboard', array_merge($filters, ['status' => 'all'])) }}">All
                                                    Campaigns</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('ad-manager.dashboard', array_merge($filters, ['status' => 'active'])) }}">Active
                                                    Campaigns</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('ad-manager.dashboard', array_merge($filters, ['status' => 'paused'])) }}">Paused
                                                    Campaigns</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('ad-manager.dashboard', array_merge($filters, ['status' => 'review'])) }}">In
                                                    Review Campaigns</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('ad-manager.dashboard', array_merge($filters, ['status' => 'ended'])) }}">Ended
                                                    Campaigns</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('ad-manager.dashboard', array_merge($filters, ['status' => 'rejected'])) }}">Rejected
                                                    Campaigns</a></li>
                                        </ul>
                                    </div>

                                    <div class="dropdown filter-dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                            id="objectiveFilter" data-bs-toggle="dropdown" aria-expanded="false">
                                            @if ($filters['objective'] == 'all')
                                                All Objectives
                                            @else
                                                {{ ucfirst($filters['objective']) }}
                                            @endif
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="objectiveFilter">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('ad-manager.dashboard', array_merge($filters, ['objective' => 'all'])) }}">All
                                                    Objectives</a></li>
                                            @foreach ($objectives as $objective)
                                                <li><a class="dropdown-item"
                                                        href="{{ route('ad-manager.dashboard', array_merge($filters, ['objective' => $objective])) }}">{{ ucfirst($objective) }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <div class="dropdown">
                                        <button class="date-range dropdown-toggle" type="button" id="dateRangeFilter"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-calendar3 me-2"></i>
                                            <span>
                                                @if ($filters['date_range'] == '7')
                                                    Last 7 days
                                                @elseif($filters['date_range'] == '30')
                                                    Last 30 days
                                                @elseif($filters['date_range'] == '90')
                                                    Last 90 days
                                                @else
                                                    Custom Range
                                                @endif
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dateRangeFilter">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('ad-manager.dashboard', array_merge($filters, ['date_range' => '7'])) }}">Last
                                                    7 days</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('ad-manager.dashboard', array_merge($filters, ['date_range' => '30'])) }}">Last
                                                    30 days</a></li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('ad-manager.dashboard', array_merge($filters, ['date_range' => '90'])) }}">Last
                                                    90 days</a></li>
                                        </ul>
                                    </div>
                                </div>

                            
                            </div>
                        </div>
                    </div>

                    <!-- Performance Metrics -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card metric-card">
                                <div class="metric-label">Total Spend</div>
                                <div class="metric-value">${{ number_format($metrics['total_spend'], 2) }}</div>
                                <div class="metric-change positive">
                                    <i class="bi bi-arrow-up-short"></i> {{ rand(1, 20) }}.{{ rand(0, 9) }}% vs.
                                    previous period
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card metric-card">
                                <div class="metric-label">Impressions</div>
                                <div class="metric-value">
                                    @if ($metrics['total_impressions'] > 1000000)
                                        {{ number_format($metrics['total_impressions'] / 1000000, 1) }}M
                                    @elseif($metrics['total_impressions'] > 1000)
                                        {{ number_format($metrics['total_impressions'] / 1000, 1) }}K
                                    @else
                                        {{ number_format($metrics['total_impressions']) }}
                                    @endif
                                </div>
                                <div class="metric-change positive">
                                    <i class="bi bi-arrow-up-short"></i> {{ rand(1, 20) }}.{{ rand(0, 9) }}% vs.
                                    previous period
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card metric-card">
                                <div class="metric-label">Link Clicks</div>
                                <div class="metric-value">
                                    @if ($metrics['total_clicks'] > 1000000)
                                        {{ number_format($metrics['total_clicks'] / 1000000, 1) }}M
                                    @elseif($metrics['total_clicks'] > 1000)
                                        {{ number_format($metrics['total_clicks'] / 1000, 1) }}K
                                    @else
                                        {{ number_format($metrics['total_clicks']) }}
                                    @endif
                                </div>
                                <div class="metric-change positive">
                                    <i class="bi bi-arrow-up-short"></i> {{ rand(1, 20) }}.{{ rand(0, 9) }}% vs.
                                    previous period
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card metric-card">
                                <div class="metric-label">Cost per Result</div>
                                <div class="metric-value">${{ number_format($metrics['cost_per_result'], 2) }}</div>
                                <div class="metric-change {{ rand(0, 1) ? 'positive' : 'negative' }}">
                                    <i class="bi bi-arrow-{{ rand(0, 1) ? 'up' : 'down' }}-short"></i>
                                    {{ rand(1, 20) }}.{{ rand(0, 9) }}% vs. previous period
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Performance Charts -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <div>Performance Over Time</div>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                            id="chartMetric" data-bs-toggle="dropdown" aria-expanded="false">
                                            Impressions
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="chartMetric">
                                            <li><a class="dropdown-item" href="#">Impressions</a></li>
                                            <li><a class="dropdown-item" href="#">Clicks</a></li>
                                            <li><a class="dropdown-item" href="#">Spend</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="performanceChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">Audience Breakdown</div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="audienceChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Campaigns Table -->
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>Active Campaigns</div>
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-columns-gap me-1"></i> Customize Columns
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px;">
                                                <input class="form-check-input" type="checkbox">
                                            </th>
                                            <th>Campaign Name</th>
                                            <th>Status</th>
                                            <th>Objective</th>
                                            <th>Budget</th>
                                            <th>Spent</th>
                                            <th>Results</th>
                                            <th>Cost/Result</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Loop through campaigns here if data is available -->
                                        @if (isset($campaigns) && count($campaigns) > 0)
                                            @foreach ($campaigns as $campaign)
                                                <tr>
                                                    <td>
                                                        <input class="form-check-input" type="checkbox"
                                                            value="{{ $campaign->id }}">
                                                    </td>
                                                    <td>
                                                        <div class="fw-semibold">{{ $campaign->name }}</div>
                                                        <small class="text-muted">Created:
                                                            {{ $campaign->created_at->format('M d, Y') }}</small>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="campaign-status status-{{ $campaign->status }}"></span>
                                                        {{ ucfirst($campaign->status) }}
                                                    </td>
                                                    <td>{{ $campaign->objective }}</td>
                                                    <td>
                                                        <div>
                                                            ${{ number_format($campaign->adSets->sum('budget_amount'), 2) }}
                                                        </div>
                                                        @if ($campaign->adSets->count() > 0)
                                                            <small
                                                                class="text-muted">${{ number_format($campaign->adSets->first()->budget_amount, 2) }}/{{ $campaign->adSets->first()->budget_type }}</small>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div>${{ number_format($campaign->metrics->sum('spend'), 2) }}
                                                        </div>
                                                        <div class="progress">
                                                            @php
                                                                $totalBudget = $campaign->adSets->sum('budget_amount');
                                                                $totalSpend = $campaign->metrics->sum('spend');
                                                                $percentage =
                                                                    $totalBudget > 0
                                                                        ? min(($totalSpend / $totalBudget) * 100, 100)
                                                                        : 0;
                                                            @endphp
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: {{ $percentage }}%"
                                                                aria-valuenow="{{ $percentage }}" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>{{ $campaign->metrics->sum('conversions') }}
                                                            {{ Str::plural('conversion', $campaign->metrics->sum('conversions')) }}
                                                        </div>
                                                        <small
                                                            class="text-success">+{{ number_format(rand(1, 20), 1) }}%</small>
                                                    </td>
                                                    <td>${{ number_format($campaign->metrics->sum('cost_per_result'), 2) }}
                                                    </td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button
                                                                class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                Actions
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item"
                                                                        href="{{ route('manage-campaign.edit', $campaign->id) }}">Edit</a>
                                                                </li>
                                                                <li><a class="dropdown-item"
                                                                        href="{{ route('manage-campaign.show', $campaign->id) }}">View
                                                                        Details</a></li>
                                                                <li><a class="dropdown-item" href="#">Duplicate</a>
                                                                </li>
                                                                @if ($campaign->status == 'active')
                                                                    <li><a class="dropdown-item" href="#">Pause</a>
                                                                    </li>
                                                                @elseif($campaign->status == 'paused')
                                                                    <li><a class="dropdown-item" href="#">Resume</a>
                                                                    </li>
                                                                @endif
                                                                <li>
                                                                    <hr class="dropdown-divider">
                                                                </li>
                                                                <li>
                                                                    <form
                                                                        action="{{ route('manage-campaign.destroy', $campaign->id) }}"
                                                                        method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="dropdown-item text-danger"
                                                                            onclick="return confirm('Are you sure you want to delete this campaign?')">Delete</button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="9" class="text-center py-4">
                                                    <p class="mb-2">No campaigns found</p>
                                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#createCampaignModal">
                                                        <i class="bi bi-plus-circle me-1"></i> Create Your First Campaign
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Campaign Modal -->
        <div class="modal fade" id="createCampaignModal" tabindex="-1" aria-labelledby="createCampaignModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCampaignModalLabel">Create New Campaign</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('manage-campaign.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="campaignName" class="form-label">Campaign Name</label>
                                <input type="text" class="form-control" id="campaignName" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="campaignObjective" class="form-label">Campaign Objective</label>
                                <input type="text" class="form-control" id="campaignObjective" name="objective"
                                    placeholder="e.g., Brand Awareness, Conversions, Traffic">
                            </div>
                            <div class="mb-3">
                                <label for="campaignStatus" class="form-label">Status</label>
                                <select class="form-select" id="campaignStatus" name="status">
                                    <option value="active">Active</option>
                                    <option value="paused">Paused</option>
                                    <option value="review" selected>Review</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="campaignDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="campaignDescription" name="description" rows="3"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="startDate" class="form-label">Start Date</label>
                                        <input type="date" class="form-control" id="startDate" name="start_date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="endDate" class="form-label">End Date</label>
                                        <input type="date" class="form-control" id="endDate" name="end_date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Create Campaign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        // Performance Chart
        document.addEventListener('DOMContentLoaded', function() {
            const performanceCtx = document.getElementById('performanceChart').getContext('2d');
            const performanceChart = new Chart(performanceCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($performanceData['labels']) !!},
                    datasets: [{
                        label: 'Impressions',
                        data: {!! json_encode($performanceData['impressions']) !!},
                        borderColor: '#4267B2',
                        backgroundColor: 'rgba(66, 103, 178, 0.1)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [2, 4]
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Ability to toggle between metrics
            document.querySelectorAll('#chartMetric .dropdown-item').forEach(item => {
                item.addEventListener('click', function(e) {
                    e.preventDefault();
                    const metric = this.getAttribute('data-metric');
                    document.getElementById('chartMetric').innerText = this.innerText;

                    // Update chart dataset
                    if (metric === 'impressions') {
                        performanceChart.data.datasets[0].data = {!! json_encode($performanceData['impressions']) !!};
                        performanceChart.data.datasets[0].label = 'Impressions';
                    } else if (metric === 'clicks') {
                        performanceChart.data.datasets[0].data = {!! json_encode($performanceData['clicks']) !!};
                        performanceChart.data.datasets[0].label = 'Clicks';
                    }

                    performanceChart.update();
                });
            });

            // Audience Chart
            const audienceCtx = document.getElementById('audienceChart').getContext('2d');
            const audienceChart = new Chart(audienceCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($audienceData['labels']) !!},
                    datasets: [{
                        data: {!! json_encode($audienceData['data']) !!},
                        backgroundColor: [
                            '#4267B2',
                            '#5B7BD5',
                            '#8B9DC3',
                            '#C4CDE0',
                            '#F7F7F7'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right'
                        }
                    },
                    cutout: '70%'
                }
            });
            document.getElementById('exportData').addEventListener('click', function() {
                // Create CSV content
                let csvContent = "data:text/csv;charset=utf-8,";
                csvContent += "Campaign Name,Status,Objective,Budget,Spent,Results,Cost/Result\n";

                @foreach ($campaigns as $campaign)
                    csvContent += "{{ addslashes($campaign->name) }},";
                    csvContent += "{{ ucfirst($campaign->status) }},";
                    csvContent += "{{ addslashes($campaign->objective ?? 'N/A') }},";
                    csvContent += "${{ number_format($campaign->adSets->sum('budget_amount'), 2) }},";
                    csvContent += "${{ number_format($campaign->metrics->sum('spend') ?? 0, 2) }},";
                    csvContent += "{{ $campaign->metrics->sum('conversions') ?? 0 }} conversions,";
                    csvContent +=
                        "${{ $campaign->metrics->sum('conversions') > 0 ? number_format($campaign->metrics->sum('spend') / $campaign->metrics->sum('conversions'), 2) : '0.00' }}\n";
                @endforeach

                // Create download link
                const encodedUri = encodeURI(csvContent);
                const link = document.createElement("a");
                link.setAttribute("href", encodedUri);
                link.setAttribute("download", "ad_campaigns_report_{{ date('Y-m-d') }}.csv");
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        });
    </script>
@endsection

@section('styles')
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

        .metric-card {
            text-align: center;
            padding: 20px;
        }

        .metric-value {
            font-size: 24px;
            font-weight: 700;
            margin: 10px 0;
        }

        .metric-label {
            color: var(--light-text);
            font-size: 14px;
        }

        .metric-change {
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .metric-change.positive {
            color: var(--success-color);
        }

        .metric-change.negative {
            color: var(--danger-color);
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
            background-color: #6c757d;
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

        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
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
    </style>
@endsection
