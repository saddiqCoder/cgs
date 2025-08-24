<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Simple Customized Customer’s Garment System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f6f7fb; }
    .navbar { box-shadow: 0 2px 14px rgba(0,0,0,.06); }
    .card { border: 0; border-radius: 1rem; box-shadow: 0 8px 30px rgba(0,0,0,.05); }
    .form-section-title { font-weight: 600; margin-bottom: .25rem; }
    .required::after { content: " *"; color: #dc3545; }
    .table thead th { background:#f0f3f9; }
    .small-muted { font-size: .85rem; color: #6c757d; }
    .pill { border-radius: 999px; padding: .25rem .5rem; }
    .toolbar { gap:.5rem; display:flex; flex-wrap:wrap; }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">CCGS Admin</a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="#customers">Customers</a></li>
        <li class="nav-item"><a class="nav-link" href="#measurements">Measurements</a></li>
        <li class="nav-item"><a class="nav-link" href="#garments">Garments</a></li>
        <li class="nav-item"><a class="nav-link" href="#orders">Orders</a></li>
      </ul>
    </div>
  </div>
</nav>

<main class="container my-4">

  <!-- DASHBOARD -->
  <section class="mb-4">
    <div class="row g-3">
      <div class="col-md-3">
        <div class="card p-3">
          <div class="small-muted">Customers</div>
          <div id="statCustomers" class="h3 mb-0">0</div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3">
          <div class="small-muted">Measurements</div>
          <div id="statMeasurements" class="h3 mb-0">0</div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3">
          <div class="small-muted">Garments</div>
          <div id="statGarments" class="h3 mb-0">0</div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card p-3">
          <div class="small-muted">Orders</div>
          <div id="statOrders" class="h3 mb-0">0</div>
        </div>
      </div>
    </div>
  </section>

  <!-- TABS -->
  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="pills-customers-tab" data-bs-toggle="pill" data-bs-target="#pills-customers" type="button">Customers</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-measurements-tab" data-bs-toggle="pill" data-bs-target="#pills-measurements" type="button">Measurements</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-garments-tab" data-bs-toggle="pill" data-bs-target="#pills-garments" type="button">Garments</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-orders-tab" data-bs-toggle="pill" data-bs-target="#pills-orders" type="button">Orders</button>
    </li>
  </ul>

  <div class="tab-content" id="pills-tabContent">

    <!-- CUSTOMERS -->
    <div class="tab-pane fade show active" id="pills-customers" role="tabpanel">
      <div class="row g-3">
        <div class="col-lg-5">
          <div class="card p-3">
            <div class="form-section-title">Add / Update Customer</div>
            <div class="small-muted mb-3">Create a customer record with contact details.</div>
            <form id="formCustomer">
              <input type="hidden" name="Customer_ID" id="Customer_ID">
              <div class="mb-2">
                <label class="form-label required">Full Name</label>
                <input type="text" class="form-control" name="Full_Name" id="Full_Name" required>
              </div>
              <div class="mb-2">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="Email" id="Email">
              </div>
              <div class="mb-2">
                <label class="form-label">Phone</label>
                <input type="tel" class="form-control" name="Phone" id="Phone">
              </div>
              <div class="mb-2">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" name="Address" id="Address">
              </div>
              <div class="mb-3">
                <label class="form-label">Date Registered</label>
                <input type="date" class="form-control" name="Date_Registered" id="Date_Registered">
              </div>
              <div class="toolbar">
                <button class="btn btn-primary" type="submit">Save</button>
                <button class="btn btn-secondary" type="reset">Clear</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <div class="form-section-title">Customer List</div>
              <input id="searchCustomers" class="form-control form-control-sm" placeholder="Search...">
            </div>
            <div class="table-responsive">
              <table class="table table-sm align-middle" id="tblCustomers">
                <thead>
                  <tr>
                    <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Registered</th><th>Actions</th>
                  </tr>
                </thead>
                <tbody><!-- rows injected by JS --></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- MEASUREMENTS -->
    <div class="tab-pane fade" id="pills-measurements" role="tabpanel">
      <div class="row g-3">
        <div class="col-lg-5">
          <div class="card p-3">
            <div class="form-section-title">Add Measurement</div>
            <form id="formMeasurement">
              <input type="hidden" name="Measurement_ID" id="Measurement_ID">
              <div class="mb-2">
                <label class="form-label required">Customer</label>
                <select class="form-select" name="Customer_ID" id="M_Customer_ID" required></select>
              </div>
              <div class="row g-2">
                <div class="col-6 mb-2"><label class="form-label">Chest</label><input type="number" step="0.1" class="form-control" id="Chest"></div>
                <div class="col-6 mb-2"><label class="form-label">Waist</label><input type="number" step="0.1" class="form-control" id="Waist"></div>
                <div class="col-6 mb-2"><label class="form-label">Hip</label><input type="number" step="0.1" class="form-control" id="Hip"></div>
                <div class="col-6 mb-2"><label class="form-label">Shoulder</label><input type="number" step="0.1" class="form-control" id="Shoulder"></div>
                <div class="col-6 mb-2"><label class="form-label">Sleeve Length</label><input type="number" step="0.1" class="form-control" id="Sleeve_Length"></div>
                <div class="col-6 mb-2"><label class="form-label">Trouser Length</label><input type="number" step="0.1" class="form-control" id="Trouser_Length"></div>
                <div class="col-6 mb-2"><label class="form-label">Gown Length</label><input type="number" step="0.1" class="form-control" id="Gown_Length"></div>
              </div>
              <div class="mb-3">
                <label class="form-label">Date Taken</label>
                <input type="date" class="form-control" id="Date_Taken">
              </div>
              <div class="toolbar">
                <button class="btn btn-primary" type="submit">Save</button>
                <button class="btn btn-secondary" type="reset">Clear</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <div class="form-section-title">Measurement Records</div>
              <input id="searchMeasurements" class="form-control form-control-sm" placeholder="Search...">
            </div>
            <div class="table-responsive">
              <table class="table table-sm align-middle" id="tblMeasurements">
                <thead>
                  <tr>
                    <th>ID</th><th>Customer</th><th>Chest</th><th>Waist</th><th>Hip</th><th>Shoulder</th><th>Sleeve</th><th>Trouser</th><th>Gown</th><th>Date</th><th>Actions</th>
                  </tr>
                </thead>
                <tbody><!-- rows injected by JS --></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- GARMENTS -->
    <div class="tab-pane fade" id="pills-garments" role="tabpanel">
      <div class="row g-3">
        <div class="col-lg-5">
          <div class="card p-3">
            <div class="form-section-title">Add Garment</div>
            <form id="formGarment">
              <input type="hidden" id="Garment_ID">
              <div class="mb-2">
                <label class="form-label required">Category</label>
                <input type="text" class="form-control" id="Category" placeholder="Shirt, Trouser, Gown" required>
              </div>
              <div class="mb-2">
                <label class="form-label">Style Type</label>
                <input type="text" class="form-control" id="Style_Type" placeholder="Casual, Traditional">
              </div>
              <div class="mb-2">
                <label class="form-label">Fabric Type</label>
                <input type="text" class="form-control" id="Fabric_Type" placeholder="Cotton, Silk">
              </div>
              <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" id="Description" rows="3"></textarea>
              </div>
              <div class="toolbar">
                <button class="btn btn-primary" type="submit">Save</button>
                <button class="btn btn-secondary" type="reset">Clear</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <div class="form-section-title">Garment Catalog</div>
              <input id="searchGarments" class="form-control form-control-sm" placeholder="Search...">
            </div>
            <div class="table-responsive">
              <table class="table table-sm align-middle" id="tblGarments">
                <thead>
                  <tr>
                    <th>ID</th><th>Category</th><th>Style</th><th>Fabric</th><th>Description</th><th>Actions</th>
                  </tr>
                </thead>
                <tbody><!-- rows injected by JS --></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ORDERS -->
    <div class="tab-pane fade" id="pills-orders" role="tabpanel">
      <div class="row g-3">
        <div class="col-lg-5">
          <div class="card p-3">
            <div class="form-section-title">Create Order</div>
            <form id="formOrder">
              <input type="hidden" id="Order_ID">
              <div class="mb-2">
                <label class="form-label required">Customer</label>
                <select class="form-select" id="O_Customer_ID" required></select>
              </div>
              <div class="mb-2">
                <label class="form-label required">Garment</label>
                <select class="form-select" id="O_Garment_ID" required></select>
              </div>
              <div class="mb-2">
                <label class="form-label">Fabric Choice</label>
                <input type="text" class="form-control" id="Fabric_Choice" placeholder="e.g., Cotton 120gsm">
              </div>
              <div class="mb-2">
                <label class="form-label">Size/Notes</label>
                <input type="text" class="form-control" id="Size_Notes" placeholder="Slim fit, 1.5\" ease">
              </div>
              <div class="row g-2">
                <div class="col-6 mb-2">
                  <label class="form-label">Order Date</label>
                  <input type="date" class="form-control" id="Order_Date">
                </div>
                <div class="col-6 mb-3">
                  <label class="form-label">Status</label>
                  <select class="form-select" id="Status">
                    <option value="Pending">Pending</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Ready">Ready</option>
                    <option value="Delivered">Delivered</option>
                  </select>
                </div>
              </div>
              <div class="toolbar">
                <button class="btn btn-primary" type="submit">Save</button>
                <button class="btn btn-secondary" type="reset">Clear</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <div class="form-section-title">Orders</div>
              <input id="searchOrders" class="form-control form-control-sm" placeholder="Search...">
            </div>
            <div class="table-responsive">
              <table class="table table-sm align-middle" id="tblOrders">
                <thead>
                  <tr>
                    <th>ID</th><th>Customer</th><th>Garment</th><th>Fabric</th><th>Status</th><th>Date</th><th>Actions</th>
                  </tr>
                </thead>
                <tbody><!-- rows injected by JS --></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div> <!-- /tab-content -->
</main>

<!-- Modal (generic confirm/delete) -->
<div class="modal fade" id="confirmModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title">Confirm</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">Are you sure?</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger" id="btnConfirmYes">Yes</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap + App JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
/* ======== SIMPLE FRONT-END STATE (Replace with real API calls) ========
   For integration with PHP/MySQL:
   - Replace all local arrays and CRUD functions with fetch() calls to your endpoints:
     customers.php, measurements.php, garments.php, orders.php
   - Use JSON or form-encoded requests. Update UI after responses.
*/
let customers = [];      // {Customer_ID, Full_Name, Email, Phone, Address, Date_Registered}
let measurements = [];   // {Measurement_ID, Customer_ID, Chest, Waist, Hip, Shoulder, Sleeve_Length, Trouser_Length, Gown_Length, Date_Taken}
let garments = [];       // {Garment_ID, Category, Style_Type, Fabric_Type, Description}
let orders = [];         // {Order_ID, Customer_ID, Garment_ID, Fabric_Choice, Size_Notes, Status, Order_Date}

let seq = { cust:1, meas:1, gmt:1, ord:1 }; // simple ID generator for demo

// Utility
const byId = id => document.getElementById(id);
const formatDate = v => v ? new Date(v).toLocaleDateString() : "";
const setStats = () => {
  byId('statCustomers').textContent = customers.length;
  byId('statMeasurements').textContent = measurements.length;
  byId('statGarments').textContent = garments.length;
  byId('statOrders').textContent = orders.length;
};
const fillSelect = (el, items, idKey, labelKey) => {
  el.innerHTML = '<option value="">Select…</option>' + items.map(i => `<option value="${i[idKey]}">${i[labelKey]}</option>`).join('');
};

// Search helper
function attachSearch(inputId, tableId) {
  byId(inputId).addEventListener('input', e => {
    const q = e.target.value.toLowerCase();
    document.querySelectorAll(`#${tableId} tbody tr`).forEach(tr => {
      tr.style.display = tr.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
  });
}

// Renderers
function renderCustomers() {
  const tb = document.querySelector('#tblCustomers tbody');
  tb.innerHTML = customers.map(c => `
    <tr>
      <td>${c.Customer_ID}</td>
      <td>${c.Full_Name}</td>
      <td>${c.Email||''}</td>
      <td>${c.Phone||''}</td>
      <td>${formatDate(c.Date_Registered)}</td>
      <td>
        <button class="btn btn-sm btn-outline-primary" onclick="editCustomer(${c.Customer_ID})">Edit</button>
        <button class="btn btn-sm btn-outline-danger" onclick="deleteCustomer(${c.Customer_ID})">Delete</button>
      </td>
    </tr>`).join('');
  fillSelect(byId('M_Customer_ID'), customers, 'Customer_ID', 'Full_Name');
  fillSelect(byId('O_Customer_ID'), customers, 'Customer_ID', 'Full_Name');
  setStats();
}
function renderMeasurements() {
  const tb = document.querySelector('#tblMeasurements tbody');
  tb.innerHTML = measurements.map(m => {
    const cust = customers.find(c => c.Customer_ID===m.Customer_ID);
    return `<tr>
      <td>${m.Measurement_ID}</td>
      <td>${cust?cust.Full_Name:'-'}</td>
      <td>${m.Chest||''}</td>
      <td>${m.Waist||''}</td>
      <td>${m.Hip||''}</td>
      <td>${m.Shoulder||''}</td>
      <td>${m.Sleeve_Length||''}</td>
      <td>${m.Trouser_Length||''}</td>
      <td>${m.Gown_Length||''}</td>
      <td>${formatDate(m.Date_Taken)}</td>
      <td>
        <button class="btn btn-sm btn-outline-primary" onclick="editMeasurement(${m.Measurement_ID})">Edit</button>
        <button class="btn btn-sm btn-outline-danger" onclick="deleteMeasurement(${m.Measurement_ID})">Delete</button>
      </td>
    </tr>`;
  }).join('');
  setStats();
}
function renderGarments() {
  const tb = document.querySelector('#tblGarments tbody');
  tb.innerHTML = garments.map(g => `
    <tr>
      <td>${g.Garment_ID}</td>
      <td>${g.Category}</td>
      <td>${g.Style_Type||''}</td>
      <td>${g.Fabric_Type||''}</td>
      <td>${g.Description||''}</td>
      <td>
        <button class="btn btn-sm btn-outline-primary" onclick="editGarment(${g.Garment_ID})">Edit</button>
        <button class="btn btn-sm btn-outline-danger" onclick="deleteGarment(${g.Garment_ID})">Delete</button>
      </td>
    </tr>`).join('');
  fillSelect(byId('O_Garment_ID'), garments, 'Garment_ID', 'Category');
  setStats();
}
function renderOrders() {
  const tb = document.querySelector('#tblOrders tbody');
  tb.innerHTML = orders.map(o => {
    const cust = customers.find(c=>c.Customer_ID===o.Customer_ID);
    const gmt  = garments.find(g=>g.Garment_ID===o.Garment_ID);
    return `<tr>
      <td>${o.Order_ID}</td>
      <td>${cust?cust.Full_Name:'-'}</td>
      <td>${gmt?gmt.Category:'-'}</td>
      <td>${o.Fabric_Choice||''}</td>
      <td><span class="pill bg-light border">${o.Status||'Pending'}</span></td>
      <td>${formatDate(o.Order_Date)}</td>
      <td>
        <button class="btn btn-sm btn-outline-primary" onclick="editOrder(${o.Order_ID})">Edit</button>
        <button class="btn btn-sm btn-outline-danger" onclick="deleteOrder(${o.Order_ID})">Delete</button>
      </td>
    </tr>`;
  }).join('');
  setStats();
}

// CRUD - Customers
byId('formCustomer').addEventListener('submit', e => {
  e.preventDefault();
  const id = Number(byId('Customer_ID').value);
  const payload = {
    Customer_ID: id || seq.cust++,
    Full_Name: byId('Full_Name').value.trim(),
    Email: byId('Email').value.trim(),
    Phone: byId('Phone').value.trim(),
    Address: byId('Address').value.trim(),
    Date_Registered: byId('Date_Registered').value
  };
  if (!payload.Full_Name) return alert('Full Name is required.');
  if (id) {
    const idx = customers.findIndex(c=>c.Customer_ID===id);
    customers[idx] = payload;
  } else {
    customers.push(payload);
  }
  e.target.reset(); byId('Customer_ID').value='';
  renderCustomers();

  // TODO integrate:
  // fetch('customers.php', { method: id?'PUT':'POST', body: new URLSearchParams(payload) })
});
function editCustomer(id){
  const c = customers.find(x=>x.Customer_ID===id);
  for (const [k,v] of Object.entries(c)) if (byId(k)) byId(k).value = v;
}
function deleteCustomer(id){
  customers = customers.filter(c=>c.Customer_ID!==id);
  renderCustomers();
  // TODO: fetch('customers.php?id='+id, { method:'DELETE' })
}

// CRUD - Measurements
byId('formMeasurement').addEventListener('submit', e => {
  e.preventDefault();
  const id = Number(byId('Measurement_ID').value);
  const payload = {
    Measurement_ID: id || seq.meas++,
    Customer_ID: Number(byId('M_Customer_ID').value),
    Chest: +byId('Chest').value || null,
    Waist: +byId('Waist').value || null,
    Hip: +byId('Hip').value || null,
    Shoulder: +byId('Shoulder').value || null,
    Sleeve_Length: +byId('Sleeve_Length').value || null,
    Trouser_Length: +byId('Trouser_Length').value || null,
    Gown_Length: +byId('Gown_Length').value || null,
    Date_Taken: byId('Date_Taken').value
  };
  if (!payload.Customer_ID) return alert('Select a customer.');
  if (id) {
    const i = measurements.findIndex(m=>m.Measurement_ID===id);
    measurements[i] = payload;
  } else {
    measurements.push(payload);
  }
  e.target.reset(); byId('Measurement_ID').value='';
  renderMeasurements();

  // TODO: fetch('measurements.php', { method: id?'PUT':'POST', body: new URLSearchParams(payload) })
});
function editMeasurement(id){
  const m = measurements.find(x=>x.Measurement_ID===id);
  byId('Measurement_ID').value = m.Measurement_ID;
  byId('M_Customer_ID').value = m.Customer_ID;
  ['Chest','Waist','Hip','Shoulder','Sleeve_Length','Trouser_Length','Gown_Length','Date_Taken']
    .forEach(k => byId(k).value = m[k] ?? '');
}
function deleteMeasurement(id){
  measurements = measurements.filter(m=>m.Measurement_ID!==id);
  renderMeasurements();
  // TODO: fetch('measurements.php?id='+id, { method:'DELETE' })
}

// CRUD - Garments
byId('formGarment').addEventListener('submit', e => {
  e.preventDefault();
  const id = Number(byId('Garment_ID').value);
  const payload = {
    Garment_ID: id || seq.gmt++,
    Category: byId('Category').value.trim(),
    Style_Type: byId('Style_Type').value.trim(),
    Fabric_Type: byId('Fabric_Type').value.trim(),
    Description: byId('Description').value.trim()
  };
  if (!payload.Category) return alert('Category is required.');
  if (id) {
    const i = garments.findIndex(g=>g.Garment_ID===id);
    garments[i] = payload;
  } else {
    garments.push(payload);
  }
  e.target.reset(); byId('Garment_ID').value='';
  renderGarments();

  // TODO: fetch('garments.php', { method: id?'PUT':'POST', body: new URLSearchParams(payload) })
});
function editGarment(id){
  const g = garments.find(x=>x.Garment_ID===id);
  ['Garment_ID','Category','Style_Type','Fabric_Type','Description'].forEach(k => byId(k).value = g[k] ?? '');
}
function deleteGarment(id){
  garments = garments.filter(g=>g.Garment_ID!==id);
  renderGarments();
  // TODO: fetch('garments.php?id='+id, { method:'DELETE' })
}

// CRUD - Orders
byId('formOrder').addEventListener('submit', e => {
  e.preventDefault();
  const id = Number(byId('Order_ID').value);
  const payload = {
    Order_ID: id || seq.ord++,
    Customer_ID: Number(byId('O_Customer_ID').value),
    Garment_ID: Number(byId('O_Garment_ID').value),
    Fabric_Choice: byId('Fabric_Choice').value.trim(),
    Size_Notes: byId('Size_Notes').value.trim(),
    Status: byId('Status').value,
    Order_Date: byId('Order_Date').value
  };
  if (!payload.Customer_ID || !payload.Garment_ID) return alert('Customer and Garment are required.');
  if (id) {
    const i = orders.findIndex(o=>o.Order_ID===id);
    orders[i] = payload;
  } else {
    orders.push(payload);
  }
  e.target.reset(); byId('Order_ID').value='';
  renderOrders();

  // TODO: fetch('orders.php', { method: id?'PUT':'POST', body: new URLSearchParams(payload) })
});
function editOrder(id){
  const o = orders.find(x=>x.Order_ID===id);
  ['Order_ID','O_Customer_ID','O_Garment_ID','Fabric_Choice','Size_Notes','Status','Order_Date'].forEach(k=>{
    if (byId(k)) byId(k).value = o[k.replace('O_','')] ?? o[k];
  });
}
function deleteOrder(id){
  orders = orders.filter(o=>o.Order_ID!==id);
  renderOrders();
  // TODO: fetch('orders.php?id='+id, { method:'DELETE' })
}

// Attach search
attachSearch('searchCustomers','tblCustomers');
attachSearch('searchMeasurements','tblMeasurements');
attachSearch('searchGarments','tblGarments');
attachSearch('searchOrders','tblOrders');

// Demo seed (optional) — remove in production
(function seed(){
  customers.push({Customer_ID:seq.cust++, Full_Name:'Ada Lovelace', Email:'ada@example.com', Phone:'08012345678', Address:'Main Street', Date_Registered:'2025-01-10'});
  garments.push({Garment_ID:seq.gmt++, Category:'Shirt', Style_Type:'Casual', Fabric_Type:'Cotton', Description:'Classic short-sleeve'});
  measurements.push({Measurement_ID:seq.meas++, Customer_ID:1, Chest:38, Waist:30, Hip:38, Shoulder:16, Sleeve_Length:24, Trouser_Length:40, Gown_Length:null, Date_Taken:'2025-02-01'});
  orders.push({Order_ID:seq.ord++, Customer_ID:1, Garment_ID:1, Fabric_Choice:'Cotton 120gsm', Size_Notes:'Slim fit', Status:'Pending', Order_Date:'2025-02-12'});
  renderCustomers(); renderGarments(); renderMeasurements(); renderOrders();
})();
</script>
</body>
</html>
