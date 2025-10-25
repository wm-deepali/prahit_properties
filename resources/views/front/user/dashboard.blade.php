@extends('layouts.front.app')

@section('title')
<title>Dashboard</title>
@endsection
<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #007bff, #4dabf7);
}
.bg-gradient-success {
    background: linear-gradient(45deg, #28a745, #51cf66);
}
.bg-gradient-warning {
    background: linear-gradient(45deg, #ffc107, #ffd43b);
}
.dashboard-area .card {
    transition: transform 0.3s, box-shadow 0.3s;
    border-radius: 10px;
    overflow:hidden;
}
.dashboard-area .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}
.card-img-top {
    height: 200px;
    object-fit: cover;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
.card-title {
    font-size: 1.1rem;
    font-weight: 600;
}
.card-text {
    font-size: 0.9rem;
}
.table th, .table td {
    vertical-align: middle;
    font-size: 0.95rem;
}
.badge {
    font-size: 0.8rem;
    padding: 0.5em 1em;
}
.table-hover tbody tr:hover {
    background-color: #f8f9fa;
}
.head-tit {
    font-weight: 700;
    color: #343a40;
}
.switch-container {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 16px;
  background: #f9f9f9;
  padding: 0px;
  border-radius: 50px;
  font-family: "Segoe UI", sans-serif;
}

.switch-label {
  font-size: 16px;
  font-weight: 600;
  color: #333;
}

/* Toggle switch styling */
.toggle-switch {
  position: relative;
  width: 60px;
  height: 30px;
  display: inline-block;
      margin: 0px;
}

.toggle-switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  inset: 0;
  background-color: #ccc;
  border-radius: 30px;
  transition: 0.3s;
}

.slider::before {
  content: "";
  position: absolute;
  height: 24px;
  width: 24px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  border-radius: 50%;
  transition: 0.3s;
}

/* When checked — move the toggle right and change color */
.toggle-switch input:checked + .slider {
  background-color: #007bff;
}

.toggle-switch input:checked + .slider::before {
  transform: translateX(30px);
}

</style>

@section('content')

<section class="breadcrumb-section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h3>My Account</h3>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">My Account</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>

<section class="owner-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
            	@include('front.user.sidebar')
            </div>
            <div class="col-sm-9">
                <div class="main-area-dash">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="head-tit">Dashboard</h3>
                        <div class="switch-container">
  <span class="switch-label">Seller</span>
  
  <label class="toggle-switch">
    <input type="checkbox" id="roleToggle">
    <span class="slider"></span>
  </label>
  
  <span class="switch-label">Buyer</span>
</div>
                    </div>
                    <hr>
                    
                    <section class="dashboard-area">
                        <!-- Report Cards -->
                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm border-0 bg-gradient-primary text-white">
                                    <div class="card-body d-flex align-items-center">
                                        <i class="fas fa-home fa-2x me-3"></i>
                                        <div>
                                            <h5 class="card-title mb-0">Total Properties</h5>
                                            <h3 class="card-text">28</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm border-0 bg-gradient-success text-white">
                                    <div class="card-body d-flex align-items-center">
                                        <i class="fas fa-eye fa-2x me-3"></i>
                                        <div>
                                            <h5 class="card-title mb-0">Profile Views</h5>
                                            <h3 class="card-text">1,892</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm border-0 bg-gradient-warning text-white">
                                    <div class="card-body d-flex align-items-center">
                                        <i class="fas fa-star fa-2x me-3"></i>
                                        <div>
                                            <h5 class="card-title mb-0">Favorites</h5>
                                            <h3 class="card-text">15</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Graphs -->
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <div class="card shadow-sm border-1">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Property Types</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="propertyTypeChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="card shadow-sm border-1">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Property Status</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="propertyStatusChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Properties Table -->
                        <div class="card shadow-sm border-1 mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Your Properties</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th scope="col">Property</th>
                                                <th scope="col">Location</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>2 BHK Apartment</td>
                                                <td>Mumbai, Bandra</td>
                                                <td>₹1.5 Cr</td>
                                                <td><span class="badge bg-success">Active</span></td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                                    <a href="#" class="btn btn-sm btn-outline-danger">Delete</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>3 BHK Villa</td>
                                                <td>Bangalore, Koramangala</td>
                                                <td>₹2.8 Cr</td>
                                                <td><span class="badge bg-warning">Pending</span></td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                                    <a href="#" class="btn btn-sm btn-outline-danger">Delete</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Commercial Plot</td>
                                                <td>Delhi, Connaught Place</td>
                                                <td>₹5 Cr</td>
                                                <td><span class="badge bg-success">Active</span></td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                                    <a href="#" class="btn btn-sm btn-outline-danger">Delete</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Exclusive Property Cards -->
                        <h5 class="mb-3">Exclusive Properties</h5>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm border-1">
                                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c" class="card-img-top" alt="Luxury Villa">
                                    <div class="card-body">
                                        <h5 class="card-title">Luxury Villa</h5>
                                        <p class="card-text">4 BHK, Goa</p>
                                        <p class="card-text text-primary fw-bold">₹3.8 Cr</p>
                                        <a href="#" class="btn btn-primary btn-sm">View Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm border-1">
                                    <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c" class="card-img-top" alt="Modern Apartment">
                                    <div class="card-body">
                                        <h5 class="card-title">Modern Apartment</h5>
                                        <p class="card-text">2 BHK, Pune</p>
                                        <p class="card-text text-primary fw-bold">₹90 Lakh</p>
                                        <a href="#" class="btn btn-primary btn-sm">View Details</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card shadow-sm border-1">
                                    <img src="https://images.unsplash.com/photo-1600566753376-77c1a8d89d69" class="card-img-top" alt="Beachfront Condo">
                                    <div class="card-body">
                                        <h5 class="card-title">Beachfront Condo</h5>
                                        <p class="card-text">3 BHK, Chennai</p>
                                        <p class="card-text text-primary fw-bold">₹2 Cr</p>
                                        <a href="#" class="btn btn-primary btn-sm">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Bar Chart for Property Types
    const ctx1 = document.getElementById('propertyTypeChart').getContext('2d');
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Apartment', 'Villa', 'Plot', 'Commercial'],
            datasets: [{
                label: 'Number of Properties',
                data: [12, 8, 5, 3],
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545'],
                borderColor: ['#0056b3', '#218838', '#e0a800', '#c82333'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Count'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Pie Chart for Property Status
    const ctx2 = document.getElementById('propertyStatusChart').getContext('2d');
    new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ['Active', 'Pending', 'Sold'],
            datasets: [{
                data: [15, 8, 5],
                backgroundColor: ['#28a745', '#ffc107', '#6c757d'],
                borderColor: ['#218838', '#e0a800', '#5a6268'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endsection

@endsection