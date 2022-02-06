<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CodeIgniter CSV Import</title>
	
    <!-- Bootstrap library -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    
</head>
<body>
<div class="container">
    <h2>Members List</h2>
	
    <!-- Display status message -->
    <?php if(!empty($success_msg)){ ?>
	 <div class="col-xs-12">
        <div class="alert alert-success"><?php echo $success_msg; ?></div>
    </div>
    <?php }if(!empty($error_msg)){ ?>
    <div class="col-xs-12">
        <div class="alert alert-danger"><?php echo $error_msg; ?></div>
    </div>
    <?php } ?>

      <div class="row">
	  <!-- direct upload -->
	  <div class="col-md-12" id="dataFrm" style="display: none;">
	  <table>
            <form action="insert-data" method="post"> 
                <tr><th>Enter employee name : </th>
					<td><input type="text" name="emp_name" placeholder="Enter employee name"/></td></tr>
				<tr><th>Enter employee code : </th>
					<td><input type="text" name="emp_code" placeholder="Enter employee code"/></td></tr>
				<tr><th>Enter employee department : </th>
					<td><input type="text" name="emp_dept" placeholder="Enter department"/></td></tr>
				<tr><th>Enter employee date of birth : </th>
					<td><input type="date" name="emp_dob" placeholder="Enter date of birth"/></td></tr>
				<tr><th>Enter employee joining date : </th>
					<td><input type="date" name="emp_jdate" placeholder="Enter joining date"/></td></tr>
                <tr><td><input type="submit" class="btn btn-primary" name="dataSubmit" value="SAVE"></td></tr>
            </form>
			</table>
        </div>
        <!-- Import link -->
     <div class="col-md-12 head">
            <div class="float-right">
				<a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('dataFrm');"><i class="plus"></i> Add Direct</a>
                <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Upload CSV file</a>				
            </div>
        </div>
		
        <!-- File upload form -->
      <div class="col-md-12" id="importFrm" style="display: none;">
            <form action="import-csv" method="post" enctype="multipart/form-data"> <!--action="<?php echo base_url('/import'); ?>"-->
                <input type="file" name="file" />
                <input type="submit" class="btn btn-primary" name="importSubmit" value="UPLOAD">
            </form>
        </div>
        
        <!-- Data list table -->
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>SL NO</th>
                    <th>Employee Code</th>
                    <th>Employee Name</th>
                    <th>Age</th>
                    <th>Department</th>
					<th>Experience in the organisation</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($members)){ foreach($members as $row){ 
					?>
                <tr>
					<td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['em_code']; ?></td>
                    <td><?php echo $row['em_name']; ?></td>					
                    <td><?php echo date_diff(date_create($row['dob']), date_create('today'))->y ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td><?php echo date_diff(date_create($row['join_date']), date_create('today'))->y ?></td>
                </tr>
                <?php } }else{ ?>
                <tr><td colspan="6">No member(s) found...</td></tr>
                <?php } ?>
            </tbody>
        </table>
   </div>
</div>

<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
</body>
</html>
