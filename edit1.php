<?php
// Include your database connection code here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "srays";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$empRec = isset($_POST["empRec"]) ? $_POST["empRec"] : '';
$pay_month = isset($_POST["pay_month"]) ? $_POST["pay_month"] : '';

$userDetails = null;

if (!empty($empRec) && !empty($pay_month)) {
    // Use prepared statements to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM payslip WHERE empRec = ? AND pay_month = ?");
    $stmt->bind_param("ss", $empRec, $pay_month);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $userDetails = $result->fetch_assoc();
    }

    $stmt->close();
}

// Close your database connection
$conn->close();
?>

<!doctype html>
<html lang="en">
  <head>
  <title>Employee pay view-modify</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="finalprocess.js" defer></script>
  <style>
     body
      {
        background-image: url(data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxAPEBAPDw8PDw8PDw8PDg0NDw8PDQ0QFRUWFhURFRUYHSggGBolGxUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKDQ0NDw0NDisZFRkrLSstNysrKystKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIAKgBLAMBIgACEQEDEQH/xAAbAAEAAwEBAQEAAAAAAAAAAAABAAMEBQIGB//EADcQAAIBAQYDBQcEAgIDAAAAAAABAgMEBREhMWESQVETIjJC0VJxgbHB4fAjYpGhcqIz4gYUFf/EABUBAQEAAAAAAAAAAAAAAAAAAAAB/8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8A/cSEIBCEIAEAcQIAgBAEAIwYsAAhCADAjIwABYAACAAwYgB4kjJaKOJsZ4kgK7BbMMKdR7Qm/kzXbK0acXKWSX8t9Ec+vSTMlojKbinLHDux4nkgMtWdS0T0/wAYLSC/OZ2LLY1SWCzk/FLr9jRY7HGlHBZyfil129xbKIGSUSqUTXKJTKIRllEyWqzKaweT8sun2OhKJVOJRmuq8pU5djW5YKE3/Sb6bn0GJ89abOprB6rwy5x+2xR/71WMHRx0bjxp4y4ecU/qQaL6vXWlSeek6i5fti+vVlV03VjhUqLLWEH5t3sXXPdGOFSou7rCD8272O7KIVklErcTVKJU4gdQQECAJAPIkACEIQCAIARgLAAIQAIwFgAAIAACAAwYgwPLPEmepMzVanJagea1Qx1U2anT/krlEqJdt5YPs6jwekZP5M7B85arPxLpJaP6M03VeTT7KrlJZRk+ez9SK7EolUol55lEDJKJVOJqlE4l6XhrTpvPSc1y/avUIqt1swbhB56SkuWy33PFGytxxeWPhXqWXfYNJzWXli+e7N8olFd13rwvsauTWUZP+ov6M7h81bbIqi6SWkvo9i2571cX2FbJrKMn/Sf0ZFd6USpxLwcQNRAECAIAQhCAQBACAIARgxYMAIQAAgsGAMBAAAQAGeJM9soqY6LV5ICupNt4LNs9wo8O7erNNKzqK6t6v6ElEDJKJTKJrlEqlEoySiZLVZlNdJLSX0ex0JRKpRCPN1Xk0+yq5SWUZPns39eZ2z520WdTWGjXhl02ex5duq9n2TeafC5p95rpj9SKtve88cadJ7TqL+4r1PF13ZpOay1jF892XXTdWOFSostYR67vY7EogZJxKpRNcolM4hGWUTFbbGqi6SXhl9HsdKUSqUSjNc96uMuwr5SWUJvn0TfyZ9CmfN22yKos8pLwy6bPYrs981aK7OcFNxy4pSaeHL3+8ivsSAQBIQAAQECAIAQBACMGLAAIQABkFgAAIAAMQAGZ68cTQeJxA82O14vgn4vLJ+bb3muUTlWijiabDbOL9Ofi8svb294F8olMomuUSqUQMkolMomucTi3jbccYU3tKa+S9QPFrtWfDB56SkuWy9TzToPhx06LYssVi0lJf4xfzZrlEqPV2Xpi+yqPCSyjJ+bZ7nWPmrZZeNYrKS0fXZmq570bfZVcprJN+bZ7kV2JRKpRNB4lEDJOJVKJrnEw3haY0o4yzbyjFayfpuEZ7ZXjTWMueUYrWT6L1OJVqub4pfBLSK6Isp06loni/i/LCPRHapWeMFwpZLrq9yj6QhCEVCAQCEIQCAIAQBACMBYMAIQAIAgAMBAAAQAAYsAK5RMloom1niUQJYLZxdyfi8svb+5rlE5NeieLVbKkocGj0lNayXQCm9bwxxp03lpOa5/tXqF3XdpOa/xi/my+7Ls0nNZaxi+e7OpOIGSUSqUTXKJTKIGWUTFbLIp5rKa0emOz9TpSiVSiVHm570bfY1cprJN+bZ7/ADO0fN2yyKe014ZfR+vIvsd8OEJRqxbqQyX79n095FdC8rZCjHGWbeUILWT9Nz5ulSqWqpi83zflhHovQtp0KlqqtvNvxS8sI9F6H0dnskaUVGKyWr5yfVgZqNmjTioxWXN82+rI4mqUStxKjqEIJFQBACEIQCAIAQBACMGRkAAEgADFgwABAABiAAAsAPJ5bPTZRVngAVZGGq8dC9pyzenIrlEo0XdeSn3JvCa0b833Okz5m1WfHOOUlpyx+50LpvPj/TqZVF1y4/uQdKUSqUTQeJRAySiVTia5RMNutEaUcXm34YrWT9NwM9qqxgsX7lFayf5zOfHiqNvV7aJckjzSpzrzbfxfliuiOrGiorBaL+WVHu5LbBfpNKMsW0/b9+52WfL22ycXejlNacsfubrlvbj/AEquVRZJvLj/AOxFdaUStxLzy4gayAQCEIQCEIQCAIAQBACMGLBgBCEAGAgwBgLAAAQYAzyz0yqpIDxVqYFUKbl3npyXUuo2fi70tOUeu7L5RAySiVSia5RKZRCMkomO1Wbi70cprNPTH49dzpSiUyiUW3TefH+nUyqLLPLiw+ux1D5u02bi70cprR6Y4afHf8WyzXvhBqabqRyS043v03IrXeNrjRji85Pww5yf0W58/RpVLRUbevml5YLoi2lQqWmo23i/NLywXReh9BQssacVGKy682+rAy07PGEeGOn9t9WEomuUSmcSoySiYLdYuPvRyqLR6Y4cseT3OrKJTKIBct7cf6VXKqss8uPD6nbPlrdYuPvR7tSPhlpjhom+T6P8V1k/8gcY8NWEnOOTawWOHVdSK+qECAJAIBCEIBAEAIAgBAYsAAhCADBiDAAEAABAAZRWL2VzQHuyWpT7sspr/ZdUXSicqvSeqyazTWqZusNr7RcMsppfCS6oD1KJVKJqlEqlEDJKJVKJrlEw220KmsXm34YrWX2CM9pqKCxfPSK1l+dTJHGbcue2i6JfA8Uqc60nJ/F8orojoxpKKwWhRoue1ww7PBRks/8APf3nTZ8zarO334ZSWeXP3bnSui9FV7k8qi/23W+xFdGUSqUTQeJRAyTiVSiapRKai/OgRlmjk2m103L/AIo1MMuOTkm/dhyPN5W7tHwU/Bjm+dR+hdQurJcbcW+Swy+5R9oAkIoEBACEIBAEAIGIgBGAsAABIAAxAAAQAAEABgxACucTFWpNPFZNZprVM3srnEC2w2xVO7LKotVykuqL5ROPVpNPijk08U1yZq/+mlBuS/UWXCtJPr7gC8bXGlHF5yfhjzf23OHRozrzbbz80uUV0S+hdSs1S0VG28X5pPSK6L0O3Ss8YRUYrBL+W+rAzQoKC4Y6L+9zxKJrlEqlEIySiYbXZW3xwyms8suL7nTlEqnEotue9FVXBPKotVpxbr0OofMWyytvjg8KizTWXF9zp3TeiqJxnhGpFPixyTS1e25FdCpgsW8ks23ol1Pl71vF1X2dPHs8cMedR+n57rb4vJ1n2dPFU8cN6j9NjddN09mlUqLvvSPsfcCi7Ls4EpzXf5L2PubXE1SiVuJUdYhCEVCEIAEIQCAIAQBACMGLBgBCEAAYsAABAAAQAGAgAM8sWeJyArqGKtgX1Z45IolEDbddpg48CwjJZte1+42tHzVenJPjhipLPLX3o6113iqqweU1quu6A1yiVSiaWiuUQMsolMomuUSmosPhq3okEZJo5dpnGcsYrZy9t9Rt1s7R8EMeDm+dR+m34tNksnAsZeLp7JRfcNOnxNvOovCnol1XVneZ8ta6Ek+0p4qUc8Fr71udW571VZcMsFUWq9rdEV0JRKnE0HlxA1EIQCEIQCEIQCAQgEAhAIwZCAQ8iQAAhABgQgAAEAjBkIBXORnk3J4L4voBAHs8F+ZlcokIVFUomG0UGn2lPFTWeC57rfbn80gHXuu8VVWDwU1rHrutjeJCKpq4JNvJLNt5JI+bvK3Oq+CGPBj8aj9NgIBssF38C4peN6L2fuapxIQqKZROdbLI0+1pYqaeOC1e63+ZCAde5r2VZcMsI1Es4+1+5HVIQiv/2Q==);
    background-repeat: no-repeat;
    background-size: cover;
    background-attachment: fixed;
    }
    .vertical-center {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
      }
    .purpleBox{
        background-color:#249bb3;
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: space-between;
        text-align: center;
        min-height: 600px;
      }

    .btn-primary {
        background-color:#249bb3;
       
      }
    .btn-primary:hover, .btn-primary:focus {
        background-color:skyblue;
            }
     .col-md-4 input{
      border-color: #8F4B84;
      display: black;
    }
    .col-md-6 input{
      border-color: #8F4B84;
    }
    .col-md-5 textarea{
      border-color: #8F4B84;
    }
     .error-input {
        border-color: red !important;
    }
   
    .col-md-4 select{
      border-color: #8F4B84;
    }
    input[type="submit"] {
    background-color: #249bb3;
    padding: 8px 16px;
    font-size: 14px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    border-radius: 5px;
    color: white;
}
     button[type="search"] a {
            color: white; 
        }
   .form-control{
    border-color: #8F4B84;
   }
   #closeButton {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
}
</style>
</head>
<body>
    <section class="vertical-center">
        <div class="container m-3">
            <div class="row rounded">
                <div class="col-md-3 purpleBox rounded-start-2 position-relative">
                    <h4 class="text-white" style="margin-top: 200px;">Employee pay-modify</h4>
                    <img src="assets/img/emp-icon.png" class="img-fluid position-absolute" alt="" />
                </div>
                <div class='col-md-9 bg-white p-3 rounded-end-2'>
                    <div class="row pb-4 mt-2">
                        <h4><center>Employee Pay -Modify</center></h4>
                    </div>
                    <form id="form" action="payslipupdate.php" method="POST">
                        <div class="row g-3 pb-4">
                            <?php
                            if ($userDetails) {
                            ?>
                                <div class="col-md-4">
                                    <label for="empRec" class="form-label">Employee Code</label>
                                    <input type="text" class="form-control" name="empRec" id="empRecInput" onkeydown="validateEmpCode(event)" maxlength="6" minlength="6" onblur="validateEmpCode(event)" value="<?php echo isset($userDetails["empRec"]) ? $userDetails["empRec"] : ''; ?>" readonly>
                                    <span id="error" style="color:red"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="empName" class="form-label">Employee Full Name</label>
                                    <input type="text" class="form-control" name="empName" id="empName" minlength="3" readonly maxlength="25" onkeyup="empNamevalidation(event)" onblur="empNamevalidation(event)" value="<?php echo isset($userDetails["empName"]) ? $userDetails["empName"] : ''; ?>">
                                    <span id="error" style="color:red"></span>
                                </div>
                                <div class="col-md-4">
                                    <label for="department" class="form-label">Department</label>
                                    <input type="text" class="form-control" name="department" id="department" readonly onkeydown="dobvalidation(event)" onchange="submitBday(event)" onblur="dobvalidation(event)" value="<?php echo isset($userDetails["department"]) ? $userDetails["department"] : ''; ?>">
                                    <span id="error" style="color:red"></span>
                                </div>
                            </div>
                            <div class="row g-3 pb-3">
                                <div class="col-md-4">
                                    <label for="bank_name" class="form-label">Bank Name</label>
                                    <input type="text" class="form-control" value="<?php echo isset($userDetails["bank_name"]) ? $userDetails["bank_name"] : ''; ?>" id="bank_name" name="bank_name">
                                </div>
                                <div class="col-md-4">
                                    <label for="account_number" class="form-label">Account Number</label>
                                    <input type="text" class="form-control" value="<?php echo isset($userDetails["account_number"]) ? $userDetails["account_number"] : ''; ?>" id="account_number" name="account_number">
                                </div>
                                <div class="col-md-4">
                                    <label for="ifsc_code" class="form-label">Ifsc Code</label>
                                    <input type="text" class="form-control" value="<?php echo isset($userDetails["ifsc_code"]) ? $userDetails["ifsc_code"] : ''; ?>" id="ifsc_code" name="ifsc_code">
                                </div>
                            </div>
                              <div class="row g-3 pb-3">
                              <div class="col-md-4">
                              <label for="base_salary" class="form-label">Base Salary</label>
                              <input type="text" class="form-control" name="base_salary" id="base_salary" value="<?php echo isset($userDetails["base_salary"]) ? $userDetails["base_salary"] : ''; ?>">
                              <span id="error_base_salary" style="color:red"></span>
                              </div>
                              <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                             <div class="col-md-4">
                              <label for="overtime" class="form-label">Overtime Pay</label>
                              <input type="text" class="form-control" name="overtime" id="overtime" value="<?php echo isset($userDetails["overtime"]) ? $userDetails["overtime"] : ''; ?>" maxlength="5" onkeypress="return isNumeric(event)" onkeyup="overtimeValidation(event)">
                              <span id="error_overtime" style="color:red"></span>
                              <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                            </div>
            
                                <div class="col-md-4">
                                    <label for="bonus" class="form-label"> Bonus</label>
                                    <input type="text" class="form-control" name="bonus" value="<?php echo isset($userDetails["bonus"]) ? $userDetails["bonus"] : ''; ?>" id="bonus" maxlength="5" minlength="4" onkeypress="return isNumeric(event)" onkeyup="bonusValidation(event)">
                                    <span id="error_bonus" style="color:red"></span>
                                    <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                                  </div> 
                                  </div>                     
                    <div class="row g-3 pb-3">
                          <div class="col-md-4">
                             <label for=" commission" class="form-label">Commission</label>
                              <input type="text" class="form-control" name=" commission" id="commission" value="<?php echo isset($userDetails["commission"]) ? $userDetails["commission"] : ''; ?>" maxlength="5" onkeypress="return isNumeric(event)"  onkeyup="commissionValidation(event)">
                              <span id="error_commission" style="color:red"></span>
                              <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                            </div>
                            <div class="col-md-4">
                            <label for=" houseRent" class="form-label">House Rent Allowance</label>
                            <input type="text" class="form-control" name=" houseRent" id="houseRent" value="<?php echo isset($userDetails["houseRent"]) ? $userDetails["houseRent"] : ''; ?>" maxlength="5" onkeypress="return isNumeric(event)" oninput="rentValidation(event)">
                            <span id="error_houseRent" style="color:red"></span>
                            <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                          </div>
                        
                        
                          <div class="col-md-4">
                            <label for="medical_allowance" class="form-label">Medical  Allowance</label>
                            <input type="text" class="form-control" name="medical_allowance" id="medical_allowance" value="<?php echo isset($userDetails["medical_allowance"]) ? $userDetails["medical_allowance"] : ''; ?>" maxlength="5" onkeypress="return isNumeric(event)"  oninput="medicalValidation(event)">
                            <span id="error_medical_allowance" style="color:red"></span>
                            <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                          </div>
                                </div>
                                         
                    <div class="row g-3 pb-3">
                          <div class="col-md-4">
                            <label for="transport_allowance" class="form-label">Transport Allowance</label>
                            <input type="text" class="form-control" name="transport_allowance" value="<?php echo isset($userDetails["transport_allowance"]) ? $userDetails["transport_allowance"] : ''; ?>" id="transport_allowance"maxlength="4" onkeypress="return isNumeric(event)"  oninput="transportValidation(event)">
                            <span id="error_transport_allowance" style="color:red"></span>
                            <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                          </div>
                        
                          <div class="col-md-4">
                            <label for="food_allowance" class="form-label">Food Allowance</label>
                            <input type="text" class="form-control" name="food_allowance" id="food_allowance" value="<?php echo isset($userDetails["food_allowance"]) ? $userDetails["food_allowance"] : ''; ?>" maxlength="4" onkeypress="return isNumeric(event)"  oninput="foodValidation(event)">
                            <span id="error_food_allowance" style="color:red"></span>
                            <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                          </div>
                          <div class="col-md-4">
                            <label for="phone_allowance" class="form-label"> Phone Allowance </label>
                            <input type="text" class="form-control" name="phone_allowance" id="phone_allowance" maxlength="4" value="<?php echo isset($userDetails["phone_allowance"]) ? $userDetails["phone_allowance"] : ''; ?>" onkeypress="return isNumeric(event)" oninput="phoneValidation(event)">
                            <span id="error_phone_allowance" style="color:red"></span>
                            <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                          </div>
                                </div>
                        
                                <div class="row g-3 pb-3">
                            <div class="col-md-4">
                                <label for=" allowances" class="form-label">Allowance</label>
                                 <input type="text" class="form-control" name=" allowances" id="allowances" value="<?php echo isset($userDetails["allowances"]) ? $userDetails["allowances"] : ''; ?>" maxlength="5" onkeypress="return isNumeric(event)"  onkeyup="allowancesValidation(event)">
                                 <span id="error_allowances" style="color:red"></span>
                                 <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                               </div>
                            
                            <div class="col-md-4">
                              <label for="tax_deductions" class="form-label">Tax Deductions</label>
                              <input type="text" class="form-control" name="tax_deductions" id="tax_deductions" maxlength="5" value="<?php echo isset($userDetails["tax_deductions"]) ? $userDetails["tax_deductions"] : ''; ?>" onkeypress="return isNumeric(event)" onkeyup="taxValidation(event)">
                              <span id="error_tax_deductions" style="color:red"></span>
                              <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                            </div>
                            
                            <div class="col-md-4">
                              <label for="insurence" class="form-label">Insurence Premium</label>
                              <input type="text" class="form-control" name="insurence" id="insurence" maxlength="4" value="<?php echo isset($userDetails["insurence"]) ? $userDetails["insurence"] : ''; ?>" onkeypress="return isNumeric(event)" onkeyup="phoneValidation(event)">
                              <span id="error_insurence" style="color:red"></span>
                              <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                            </div>
                                </div>
                                <div class="row g-3 pb-3">
                            <div class="col-md-4">
                                <label for="totalpresent" class="form-label">No of Days Presents</label>
                                 <input type="text" class="form-control" name=" totalpresent" id="totalpresent" value="<?php echo isset($userDetails["totalpresent"]) ? $userDetails["totalpresent"] : ''; ?>" maxlength="5" onkeypress="return isNumeric(event)"  onkeyup="presentValidation(event)">
                                 <span id="error_totalpresent" style="color:red"></span>
                                 <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                               </div>
                            
                            <div class="col-md-4">
                              <label for="totalupsent" class="form-label">Total number of Leaves</label>
                              <input type="text" class="form-control" name="totalupsent" id="totalupsent" value="<?php echo isset($userDetails["totalupsent"]) ? $userDetails["totalupsent"] : ''; ?>" maxlength="5" onkeypress="return isNumeric(event)" onkeyup="upsentValidation(event)">
                              <span id="error_totalupsent" style="color:red"></span>
                              <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                            </div>
                            
                            <div class="col-md-4">
                              <label for="totaldays" class="form-label">Total Days</label>
                              <input type="text" class="form-control" name="totaldays" id="totaldays" maxlength="4" value="<?php echo isset($userDetails["totaldays"]) ? $userDetails["totaldays"] : ''; ?>" onkeypress="return isNumeric(event)" onkeyup="totalValidation(event)">
                              <span id="error_totaldays" style="color:red"></span>
                              <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                            </div>
                                </div>
                              
                          <div class="row g-3 pb-3">
                    
                            <div class="col-md-4">
                              <label for="retirement" class="form-label">Retirement Contribute</label>
                              <input type="text" class="form-control" name="retirement" id="retirement" maxlength="4" value="<?php echo isset($userDetails["retirement"]) ? $userDetails["retirement"] : ''; ?>" onkeypress="return isNumeric(event)" onkeyup="retirementValidation(event)">
                              <span id="error_retirement" style="color:red"></span>
                              <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                            </div>

                            <div class="col-md-4">
                                <label for="other_deductions" class="form-label">Other Deductions</label>
                                <input type="text" class="form-control" name=" other_deductions" id="other_deductions" value="<?php echo isset($userDetails["other_deductions"]) ? $userDetails["other_deductions"] : ''; ?>" maxlength="5" onkeypress="return isNumeric(event)" onkeyup="deductionsValidation(event)">
                                <span id="error_other_deductions" style="color:red"></span>
                                <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                              </div> 
                              <div class="col-md-4">
                            <label for="pay_month" class="form-label">Pay Month</label>
                            <input type="month" id="pay_month" class="form-control" name="pay_month" readonly  value="<?php echo isset($userDetails["pay_month"]) ? $userDetails["pay_month"] : ''; ?>"  onkeypress="return isNumeric(event)" onkeyup="paymonthValidation(event)" >
                            <span id="error_pay_month" style="color:red"></span>
                        </div>
                        <div class="row g-3 pb-3">
                        <div class="col-md-4">
                            <label for="gross_earning" class="form-label">Gross Earning</label>
                            <input type="text" class="form-control" name="gross_earning" id="gross_earning" value="<?php echo isset($userDetails["gross_earning"]) ? $userDetails["gross_earning"] : ''; ?>" onkeypress="return isNumeric(event)" readonly>
                            <span id="error" style="color:red"></span>
                            <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                        </div>
                        <div class="col-md-4">
                            <label for="total_deductions" class="form-label">Total deductions</label>
                            <input type="text" class="form-control" name="total_deductions" id="total_deductions" value="<?php echo isset($userDetails["total_deductions"]) ? $userDetails["total_deductions"] : ''; ?>" onkeypress="return isNumeric(event)" readonly>
                            <span id="error" style="color:red"></span>
                            <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                        </div>
                       
    
                            <div class="col-md-4">
                              <label for="net_pay" class="form-label">Net Pay</label>
                              <input type="text" class="form-control" name="net_pay" value="<?php echo isset($userDetails["net_pay"]) ? $userDetails["net_pay"] : ''; ?>" id="net_pay"  readonly>
                              <span id="error" style="color:red"></span>
                              <script>
                                     function isNumeric(event){   return /^[0-9]*$/.test(event.key);
                                  }
                              </script>
                            
                          </div>
                           </div>
                           <div class="row g-3 pb-3">
                      
        
                        <div class="col-md-4">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" name="company_name" id="company_name" readonly value="<?php echo isset($userDetails["company_name"]) ? $userDetails["company_name"] : ''; ?>" onkeyup="cnameValidation(event)">
                            <span id="error_company_name" style="color:red"></span>
                        </div>
                    
                        <div class="col-md-4">
                            <label for="company_address" class="form-label">company Address</label>
                            <input type="text" class="form-control" name="company_address" id="company_address" readonly rows="3" value="<?php echo isset($userDetails["company_address"]) ? $userDetails["company_address"] : ''; ?>" onkeyup="caddressValidation(event)">
                            <span id="error_company_address" style="color:red"></span>
                        </div>
                        </div>
                   
                        <div class="row pt-2">
                            <div class="col-md-12 text-center">
                                <input type="submit" class="btn btn-info">
                                <button type="reset" class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                        <?php
                            } else {
                                echo "User not found.";
                            }
                            ?>

                   </form>
                    <div id="success-msg" style="color:green">
                </div>
            </div>
        </div>
        
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   
    <script>
        function isNumeric(event) {
            return /^[0-9]*$/.test(event.key);
        }

        function presentValidation(event) {
            var totalpresent = document.getElementById('totalpresent').value;
            var totalupsent = document.getElementById('totalupsent').value;

            if (parseInt(totalpresent) + parseInt(totalupsent) > 31) {
                document.getElementById('error_totalpresent').innerText = "Total present and upsent days cannot exceed 30 and 31 days.";
            } else {
                document.getElementById('error_totalpresent').innerText = "";
            }

            // Auto-calculate total days
            calculateTotalDays();
        }

        function upsentValidation(event) {
            var totalpresent = document.getElementById('totalpresent').value;
            var totalupsent = document.getElementById('totalupsent').value;

            if (parseInt(totalpresent) + parseInt(totalupsent) > 31) {
                document.getElementById('error_totalupsent').innerText = "Total days cannot exceed 31.";
            } else {
                document.getElementById('error_totalupsent').innerText = "";
            }

            // Auto-calculate total days
            calculateTotalDays();
        }

        function calculateTotalDays() {
            var totalpresent = parseInt(document.getElementById('totalpresent').value) || 0;
            var totalupsent = parseInt(document.getElementById('totalupsent').value) || 0;
            var totaldays = totalpresent - totalupsent;
            document.getElementById('totaldays').value = totaldays > 0 ? totaldays : 0;
        }
    </script>
<script>
  function calculateSalary() {
    // Get values from input fields
    var baseSalary = parseFloat(document.getElementById('base_salary').value) || 0;
    var overtime = parseFloat(document.getElementById('overtime').value) || 0;
    var bonus = parseFloat(document.getElementById('bonus').value) || 0;
    var allowance = parseFloat(document.getElementById('allowances').value) || 0;

    // Calculate Gross Earning
    var grossEarning = baseSalary + overtime + bonus + allowance;
    document.getElementById('gross_earning').value = grossEarning.toFixed(2);

    // Get values for Total Deductions
    var commission = parseFloat(document.getElementById('commission').value) || 0;
    var taxDeductions = parseFloat(document.getElementById('tax_deductions').value) || 0;
    var insurance = parseFloat(document.getElementById('insurence').value) || 0;
    var retirement = parseFloat(document.getElementById('retirement').value) || 0;
    var otherDeductions = parseFloat(document.getElementById('other_deductions').value) || 0;

    // Calculate Total Deductions
    var totalDeductions = commission + taxDeductions + insurance + retirement + otherDeductions;
    document.getElementById('total_deductions').value = totalDeductions.toFixed(2);

    // Calculate Net Pay
    var netPay = grossEarning - totalDeductions;
    document.getElementById('net_pay').value = netPay.toFixed(2);
}

// Attach the calculateSalary function to relevant input fields
var relevantFields = ['base_salary', 'overtime', 'bonus', 'allowances', 'commission', 'tax_deductions', 'insurence', 'retirement', 'other_deductions'];
relevantFields.forEach(function (field) {
    document.getElementById(field).addEventListener('input', calculateSalary);
});

    // Function to calculate Allowance based on individual allowance fields
    function calculateAllowance() {
        // Get values from input fields
        var phoneAllowance = parseFloat(document.getElementById('phone_allowance').value) || 0;
        var foodAllowance = parseFloat(document.getElementById('food_allowance').value) || 0;
        var transportAllowance = parseFloat(document.getElementById('transport_allowance').value) || 0;
        var medicalAllowance = parseFloat(document.getElementById('medical_allowance').value) || 0;
        var houseRentAllowance = parseFloat(document.getElementById('houseRent').value) || 0;

        // Calculate total Allowance
        var totalAllowance = phoneAllowance + foodAllowance + transportAllowance + medicalAllowance + houseRentAllowance;
        
        // Update the Allowance field
        document.getElementById('allowances').value = totalAllowance.toFixed(2);

        // Call the calculateSalary function to update other fields
        calculateSalary();
    }

    // Attach the calculateAllowance function to relevant input fields
    var allowanceFields = ['phone_allowance', 'food_allowance', 'transport_allowance', 'medical_allowance', 'houseRent'];
    allowanceFields.forEach(function (field) {
        document.getElementById(field).addEventListener('input', calculateAllowance);
    });
</script>
<button id="closeButton" class="btn-close" aria-label="Close"></button>
   <script>
    // Get a reference to the close button
    var closeButton = document.getElementById('closeButton');

    // Add a click event listener to the close button
    closeButton.addEventListener('click', function() {
        // Redirect to the desired page (e.g., "emdash.html")
        window.location.href = "paymodify.php";
    });
</script>

</body>
</html>