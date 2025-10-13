<div class="main-content">
    <header class="d-flex justify-content-between align-items-center mb-4 p-4 rounded bg-white shadow-sm">
        <h1 class="h3 mb-0">Dashboard</h1>
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-primary">+ Buddy Punching</button>
            <button class="btn btn-secondary">Manager POV</button>
            <div class="d-flex align-items-center gap-2">
                <span class="text-muted">EN</span>
                <i class="bi bi-bell-fill"></i>
                <img src="https://via.placeholder.com/40" alt="User" class="rounded-circle">
            </div>
        </div>
    </header>
    <main>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mb-4">
            <div class="card p-4 shadow-sm flex-grow-1">
                <h5 class="fw-bold">Hey,Good to see you</h5>
                <p class="text-muted mb-0">You came 15 minutes early today.</p>
            </div>
            <div class="d-flex gap-3 punch-card p-3">
                <div class="d-flex flex-column align-items-center">
                    <div class="punch-status-indicator-in mb-2"></div>
                    <span class="time">7:14 AM</span>
                    <small class="text-muted">Punch In</small>
                </div>
                <div class="d-flex flex-column align-items-center">
                    <div class="punch-status-indicator-out mb-2"></div>
                    <span class="time">05:00 PM</span>
                    <small class="text-muted">Punch Out</small>
                </div>
            </div>
        </div>



        <div class="row g-3 mb-4">
            <div class="col-lg-3 col-md-6">
                <div class="card p-3 shadow-sm summary-card">
                    <small class="text-muted">Total leave allowance</small>
                    <h2 class="fw-bold my-2">34</h2>
                    <div class="d-flex gap-3 text-muted">
                        <small>Paid: <span>11</span></small>
                        <small>Unpaid: <span>4</span></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card p-3 shadow-sm summary-card">
                    <small class="text-muted">Total leave taken</small>
                    <h2 class="fw-bold my-2">20</h2>
                    <div class="d-flex gap-3 text-muted">
                        <small>Paid: <span>11</span></small>
                        <small>Unpaid: <span>11</span></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card p-3 shadow-sm summary-card">
                    <small class="text-muted">Total leave available</small>
                    <h2 class="fw-bold my-2">87</h2>
                    <div class="d-flex gap-3 text-muted">
                        <small>Paid: <span>50</span></small>
                        <small>Unpaid: <span>51</span></small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card p-3 shadow-sm summary-card">
                    <small class="text-muted">Leave request pending</small>
                    <h2 class="fw-bold my-2">122</h2>
                    <div class="d-flex gap-3 text-muted">
                        <small>Paid: <span>60</span></small>
                        <small>Unpaid: <span>62</span></small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card p-4 shadow-sm mb-4">
            <h5 class="card-title border-bottom pb-3 mb-4">Time Log</h5>
            <div class="row">
                <div class="col-md-6 border-end">
                    <h6 class="fw-bold mb-3">Today</h6>
                    <div class="d-flex gap-4">
                        <div class="text-center">
                            <span class="d-block fw-bold">08:00</span>
                            <small class="text-muted">Punch In</small>
                        </div>
                        <div class="text-center">
                            <span class="d-block fw-bold">12:00</span>
                            <small class="text-muted">Balance</small>
                        </div>
                        <div class="text-center">
                            <span class="d-block fw-bold">05:00</span>
                            <small class="text-muted">Worked</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ps-4">
                    <h6 class="fw-bold mb-3">This month</h6>
                    <div class="progress-bar-container">
                        <div class="d-flex justify-content-between mb-1">
                            <small class="fw-bold">Shortage time</small>
                            <small class="fw-bold">216 hour</small>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Shortage time" aria-valuenow="70"
                            aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                    </div>
                    <div class="progress-bar-container">
                        <div class="d-flex justify-content-between mb-1">
                            <small class="fw-bold">Worked time</small>
                            <small class="fw-bold">189 hour</small>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Worked time" aria-valuenow="85"
                            aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: 85%"></div>
                        </div>
                    </div>
                    <div class="progress-bar-container">
                        <div class="d-flex justify-content-between mb-1">
                            <small class="fw-bold">Over time</small>
                            <small class="fw-bold">56 hour</small>
                        </div>
                        <div class="progress" role="progressbar" aria-label="Over time" aria-valuenow="45"
                            aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: 45%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card p-4 shadow-sm">
            <h5 class="card-title border-bottom pb-3 mb-4">Announcements</h5>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr class="text-muted">
                            <th scope="col">Title</th>
                            <th scope="col">Start date</th>
                            <th scope="col">End date</th>
                            <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Scrum Master</td>
                            <td>Dec 4, 2019</td>
                            <td>Dec 7, 2019</td>
                            <td>Corrected item alignment.</td>
                        </tr>
                        <tr>
                            <td>Software Tester</td>
                            <td>Dec 30, 2019</td>
                            <td>Feb 2, 2019</td>
                            <td>Embedded analytic scripts.</td>
                        </tr>
                        <tr>
                            <td>Software Developer</td>
                            <td>Dec 30, 2019</td>
                            <td>Dec 4, 2019</td>
                            <td>High resolution imagery option.</td>
                        </tr>
                        <tr>
                            <td>UUUX Designer</td>
                            <td>Dec 7, 2019</td>
                            <td>Feb 2, 2019</td>
                            <td>Enhanced UX for cart quantity updates.</td>
                        </tr>
                        <tr>
                            <td>Ethical Hacker</td>
                            <td>Mar 20, 2019</td>
                            <td>Dec 4, 2019</td>
                            <td>Cart history fixes.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>