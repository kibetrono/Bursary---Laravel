<!DOCTYPE html>
<html>
<head>
  <title>Tabbed Page Example</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="tab-container">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#step-1" data-toggle="tab">Step 1</a></li>
      <li><a href="#step-2" data-toggle="tab">Step 2</a></li>
      <li><a href="#step-3" data-toggle="tab">Step 3</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="step-1">
        <h3>Step 1</h3>
        <p>This is the body content for Step 1.</p>
      </div>
      <div class="tab-pane" id="step-2">
        <h3>Step 2</h3>
        <p>This is the body content for Step 2.</p>
      </div>
      <div class="tab-pane" id="step-3">
        <h3>Step 3</h3>
        <p>This is the body content for Step 3.</p>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
