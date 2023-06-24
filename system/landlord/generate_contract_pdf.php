<?php
use Mpdf\Mpdf;
require_once 'vendor/autoload.php';
require 'database.php';

// Function to generate a random contract ID
function generateContractID($length = 5) {
    $characters = '0123456789';
    $contractID = '';
    for ($i = 0; $i < $length; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $contractID .= $characters[$index];
    }
    return $contractID;
}

$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
$imagePath = 'http://localhost/Tenant/system/landlord/photos/logo.png';
$imageHtml = '<img src="' . $imagePath . '">';

$userId = $_POST['userId'] ?? '';
$firstName = $_POST['firstName'] ?? '';
$surname = $_POST['surname'] ?? '';
$propertyName = $_POST['propertyName'] ?? '';
$propertyCity = $_POST['propertyCity'] ?? '';
$propertyId = $_POST['propertyId'] ?? '';
$streetAddress = $_POST['streetAddress'] ?? '';
$rooms = $_POST['rooms'] ?? '';
$deposit = $_POST['deposit'] ?? '';
$monthlyRateValue = $_POST['monthlyRateValue'] ?? '';
$movein = $_POST['movein'] ?? '';
$endDate = $_POST['endDate'] ?? '';
$formattedMonthly = 'MWK ' . number_format((float)$monthlyRateValue, 2, '.', ',');
$formattedDeposit = 'MWK ' . number_format((float)$deposit, 2, '.', ',');

do {
    $contractID = generateContractID();
    $checkQuery = "SELECT * FROM `contract` WHERE contract_id = '$contractID'";
    $checkResult = mysqli_query($conn, $checkQuery);
} while (mysqli_num_rows($checkResult) > 0);

$sql = "INSERT INTO `contract` (contract_id, user_id, property_id, first_name, last_name, monthly_rent, contract_start_date, contract_end_date, contract_status) 
        VALUES ('$contractID', '$userId', '$propertyId','$firstName','$surname', '$monthlyRateValue', '$movein', '$endDate', '1')";

if (mysqli_query($conn, $sql)) {
    echo "Contract inserted successfully.";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);

// Generate content
$contractContent = <<<EOD
<h1>RESIDENTIAL HOUSE LEASE AGREEMENT</h1>
<p>This agreement is made between the landlord and the tenant as follows:</p>
<h3> <u> Tenant Information </u></h3>
<p><strong>Tenant ID:</strong> $userId</p>
<p><strong> First Name:</strong> $firstName</p>
<p><strong>Last Name:</strong> $surname</p>

<p> This Residential House Lease Agreement ("Lease") is made and effective 
this <strong> $movein </strong> by and between [Landlord] ("Landlord") and [Tenant One] 
 ("Tenant," whether one or more).  This Lease creates joint and several liability in 
 the case of multiple Tenants. </p>

 <h3> <u> PREMESIS <u/> </h3> 
 <P>Landlord hereby rents to Tenant and Tenant accepts in its 
 present condition the house at following address: </P>

 <P> <strong> Property Name: </strong> $propertyName </p>
 <P> <strong> Property City: </strong> $propertyCity </p>
 <P> <strong> Property Address: </strong> $streetAddress </p>
 <P> <strong> Number of rooms: </strong> $rooms </p>

 <h3> <u> TERM</u> </h3> 
 <p>
 The term of this Lease shall start on <strong> $movein </strong> , and end on <strong> $endDate </strong>. 
  In the event that Landlord is unable to provide the House on the exact start date, 
  then Landlord shall provide the House as soon as possible, 
  and Tenant's obligation to pay rent shall abate during such period.Tenant shall not be 
  entitled to any other remedy for any delay in providing the House.
  </p>

  <h3> <u>RENT </u> </h3>  
  <p> 
  Tenant agrees to pay, without demand, to Landlord as rent for 
  the House the sum of <strong> $formattedMonthly </strong> per month in advance on the first
   day of each calendar month, at [Address for Rent Payments], or at such other 
   place as Landlord may designate.  Landlord may impose a late payment charge of
    [Late Pay Charge] per day for any amount that is more than five (5) days late.
      Rent will be prorated if the term does not start on
   the first day of the month or for any other partial month of the term.
  </p> 

 <h3>SECURITY DEPOSIT </h3>
 <p>Tenant agrees to deposit of <strong>$formattedDeposit</strong> (including deposit fees) <p>
  following the full and faithful performance by Tenant of this Lease.  In the event of damage to the House caused by Tenant or Tenant's family, agents or visitors, Landlord may use funds from the deposit to repair,
  but is not limited to this fund and Tenant remains liable.</p>

  <h2> QUIET ENJOYMENT</h2>
  <p> Landlord agrees that if Tenant timely pays the rent and performs the other obligations in this Lease, Landlord will 
  not interfere with Tenant's peaceful
   use and enjoyment of the House. </p>


EOD;
$mpdf = new Mpdf();
$mpdf->SetFontSize(11);
// Set mPDF options if needed (e.g., page size, orientation, etc.)
// $mpdf->SetPageSize('A4');
$filename = 'tenant_contract_' . $firstName . '_' . $surname . '_' . $contractID . '.pdf';
// Generate PDF from the contract content
$mpdf->WriteHTML($imageHtml);
$mpdf->WriteHTML($contractContent);
$mpdf->Output($filename, 'D');
?>
