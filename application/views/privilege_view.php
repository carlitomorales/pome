<?php include('header.php'); ?>
<?php
	$privilege_id = '';
	$privilege_name = '';
	foreach($privilege as $row){
		$privilege_id = $row['privilege_id'];
		$privilege_name = $row['privilege_name'];
	}
?>

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="<?php echo base_url();?>dashboard">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="<?php echo base_url();?>privilege">Privilege</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">View</a>
					</li>
				</ul>
			</div>
			
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><span class="icon icon-color icon-key"></span> View Privilege</h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
						<form id="formadd" class="form-horizontal" action="" method="post">
						<fieldset>
							<legend>Privilege Detail</legend>
							<div class="control-group">
							  <label class="control-label" for="privilege_name">Privilege Name </label>
							  <div class="controls">
								<input type="text" class="span6" id="privilege_name" name="privilege_name" value="<?php echo $privilege_name;?>" disabled="disabled" />
								<input type="hidden" name="privilege_id" id="privilege_id" value="<?php echo $privilege_id;?>"
							  </div>
							</div>
						</fieldset> 
						<fieldset>
							<legend>Privilege Modules</legend>
							<table class="table">
								<thead>
									<tr>
										<th colspan="2">Module</th>
										<th colspan="6">Access Rights</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$lastgroupname = '';
									foreach($modules as $rowmodule){
										$group_name = $rowmodule['group_name'];
										$module_id = $rowmodule['module_id'];
										$module_name = $rowmodule['module_name'];
										$add = $rowmodule['add'];
										$edit = $rowmodule['edit'];
										$delete = $rowmodule['delete'];
										$approve = $rowmodule['approve'];
										$list = $rowmodule['list'];
										$view = $rowmodule['view'];
										$print = $rowmodule['print'];
										if($group_name != $lastgroupname){
											$lastgroupname = $group_name;
								?>
									<tr>
										<td><strong><?php echo $group_name;?></strong></td>
										<td>&nbsp;</td>										
										<td>Add</td>
										<td>Edit</td>
										<td>Delete</td>
										<td>Approve</td>
										<td>List</td>
										<td>View</td>
										<td>Print</td>
									</tr>
								<?php
										}
								?>
									<tr>
										<td>&nbsp;</td>
										<td><?php echo $module_name;?>
											<input type="hidden" name="module_id[]" value="<?php echo $module_id;?>" />
										</td>
										<td>
											<input type="checkbox" name="add_<?php echo $module_id;?>" value="1" <?php echo(($add==1) ? "checked" : "");?> disabled="disabled" />
										</td>
										<td>
											<input type="checkbox" name="edit_<?php echo $module_id;?>" value="1" <?php echo(($edit==1) ? "checked" : "");?> disabled="disabled" />
										</td>
										<td>
											<input type="checkbox" name="delete_<?php echo $module_id;?>" value="1" <?php echo(($delete==1) ? "checked" : "");?> disabled="disabled" />
										</td>
										<td>
											<input type="checkbox" name="approve_<?php echo $module_id;?>" value="1" <?php echo(($approve==1) ? "checked" : "");?> disabled="disabled" />
										</td>
										<td>
											<input type="checkbox" name="list_<?php echo $module_id;?>" value="1" <?php echo(($list==1) ? "checked" : "");?> disabled="disabled" />
										</td>
										<td>
											<input type="checkbox" name="view_<?php echo $module_id;?>" value="1" <?php echo(($view==1) ? "checked" : "");?> disabled="disabled" />
										</td>
										<td>
											<input type="checkbox" name="print_<?php echo $module_id;?>" value="1" <?php echo(($print==1) ? "checked" : "");?> disabled="disabled" />
										</td>
									</tr>
								<?php
									}
								?>
								</tbody>
							</table>
						</fieldset> 
						</form>   
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
    
<?php include('footer.php'); ?>