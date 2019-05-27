<?php
$con=mysqli_connect('localhost','Lifestandate','TreckN@zional7'); 
mysqli_select_db($con,'TrekSocialDB');
if(!$con)
{
	die("connection failed" . mysqli_error($con));
}

$dest_name = $_GET['dest'];

$sql = "Select * from destinations where destination_name = '".$dest_name."'";
$sql_exec = mysqli_query($con,$sql);

$row = $sql_exec->fetch_assoc();
//print_r($row);

?>
<div class="form-group">
  <label class="col-lg-3 control-label" for="dist_name">District</label>
  <div class="dropdown col-lg-4">
    <select autocomplete="off" class="form-control" name="dist_name">
      <option selected="selected">Select District</option>
      <?php if($row['district'] == 'Ahmednagar'){$selected = 'selected';}else{$selected = '';} ?>
      <option <?php echo $selected; ?> value="Ahmednagar">Ahmednagar</option>
      <?php if($row['district'] == 'Kolhapur'){$selected = 'selected';}else{$selected = '';} ?>
      <option <?php echo $selected; ?> value="Kolhapur">Kolhapur</option>
      <?php if($row['district'] == 'Nashik'){$selected = 'selected';}else{$selected = '';} ?>
      <option <?php echo $selected; ?> value="Nashik">Nashik</option>
      <?php if($row['district'] == 'Pune'){$selected = 'selected';}else{$selected = '';} ?>
      <option <?php echo $selected; ?> value="Pune">Pune</option>
      <?php if($row['district'] == 'Raigad'){$selected = 'selected';}else{$selected = '';} ?>
      <option <?php echo $selected; ?> value="Raigad">Raigad</option>
      <?php if($row['district'] == 'Satara'){$selected = 'selected';}else{$selected = '';} ?>
      <option <?php echo $selected; ?> value="Satara">Satara</option>
    </select>
  </div>
</div>
&nbsp;<br />
&nbsp;
<div class="form-group">
  <label class="col-lg-3 control-label" for="trekDifficulty">Difficulty level</label>
  <div class="dropdown col-lg-4">
    <select autocomplete="off" class="form-control" name="trekDifficulty">
      <option selected="selected">Select difficulty level</option>
      <?php if($row['difficulty'] == '1'){$selected = 'selected';}else{$selected = '';} ?>
      <option <?php echo $selected; ?> value="1">1</option>
      <?php if($row['difficulty'] == '2'){$selected = 'selected';}else{$selected = '';} ?>
      <option <?php echo $selected; ?> value="2">2</option>
      <?php if($row['difficulty'] == '3'){$selected = 'selected';}else{$selected = '';} ?>
      <option <?php echo $selected; ?> value="3">3</option>
      <?php if($row['difficulty'] == '4'){$selected = 'selected';}else{$selected = '';} ?>
      <option <?php echo $selected; ?> value="4">4</option>
      <?php if($row['difficulty'] == '5'){$selected = 'selected';}else{$selected = '';} ?>
      <option <?php echo $selected; ?> value="5">5</option>
    </select>
  </div>
</div>
&nbsp;<br />
&nbsp;
<div class="form-group">
  <label class="col-lg-3 control-label" for="trekEndurance">Endurance level</label>
  <div class="dropdown col-lg-4">
    <select autocomplete="off" class="form-control" name="endurance">
      <option>Select endurance level</option>
      <?php if($row['endurance'] == '1'){$selected = 'selected';}else{$selected = '';} ?>
      <option <?php echo $selected; ?> value="1">1</option>
      <?php if($row['endurance'] == '2'){$selected = 'selected';}else{$selected = '';} ?>
      <option <?php echo $selected; ?> value="2">2</option>
      <?php if($row['endurance'] == '3'){$selected = 'selected';}else{$selected = '';} ?>
      <option <?php echo $selected; ?> value="3">3</option>
      <?php if($row['endurance'] == '4'){$selected = 'selected';}else{$selected = '';} ?>
      <option <?php echo $selected; ?> value="4">4</option>
      <?php if($row['endurance'] == '5'){$selected = 'selected';}else{$selected = '';} ?>
      <option <?php echo $selected; ?> value="5">5</option>
    </select>
  </div>
</div>
&nbsp;<br />
&nbsp;
<div class="form-group">
  <label class="col-lg-3 control-label" for="height">Height</label>
  <div class="dropdown col-lg-4">
    <input type="text" name="height" value="<?php echo $row['height']; ?>" class="form-control">
  </div>
</div>
<br />
<br />
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp;
<input align="center" class="btn btn-success" name='Save' id="submit" type="submit" value='Update'>
