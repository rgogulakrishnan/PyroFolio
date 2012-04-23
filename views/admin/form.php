<section class="title">
	<?php if ($this->method == 'add'): ?>
		<h4><?php echo lang('portfolio.add_project_title'); ?></h4>
	<?php else: ?>
		<h4><?php echo lang('portfolio.edit_project_title'); ?></h4>
	<?php endif; ?>
</section>

<section class="item">
	
	<?php echo form_open(uri_string(), 'class="crud"'); ?>
	
	<div class="form_inputs">

		<fieldset>
			
			<ul>
				<li class="even">
					<label for="title"><?php echo lang('portfolio.project_label'); ?> <span>*</span></label>
					<div class="input"><?php echo form_input('title', htmlspecialchars_decode($project->title), 'maxlength="100" style="width:70%"'); ?></div>				
				</li>
				
				<li>
					<label for="slug"><?php echo lang('portfolio.slug_label'); ?> <span>*</span></label>
					<div class="input"><?php echo form_input('slug', $project->slug, 'maxlength="100" style="width:70%"'); ?></div>
				</li>

				<li class="even">
					<label for="category">
						<?php echo lang('portfolio.category_label'); ?>
						<span>*</span>
						<span style="color:#aaa;font-size:10px;font-weight:normal;">
							<br><em><?php echo lang('portfolio.type_tooltip'); ?></em>
						</span>
					</label>
					<div class="input"><?php echo form_input('category', $project->category, 'maxlength="100"'); ?></div>
				</li>

				<li>
					<label for="delivered">
						<?php echo lang('portfolio.delivered_label'); ?> 
						<span>*</span>
						<span style="color:#aaa;font-size:10px;font-weight:normal;">
							<br><em><?php echo lang('portfolio.date_tooltip'); ?></em>
						</span>
					</label>
					<div class="input">
						<?php echo form_dropdown('delivered_month', 
							array(
								'January' =>'January', 
								'February' =>'February',
								'March' =>'March', 
								'April' =>'April',  
								'May' =>'May', 
								'June' =>'June',
								'July' =>'July', 
								'August' =>'August', 
								'September' =>'September', 
								'October' =>'October',
								'November' =>'November', 
								'December' =>'December', 
							), $project->delivered_month) 
						?>
						
					</div>
					<div class="input"><?php echo form_input('delivered_year', $project->delivered_year, 'maxlength="4"'); ?></div>
				</li>

				<li class="even">
					<label for="services">
						<?php echo lang('portfolio.services_label'); ?> 
						<span>*</span>
						<span style="color:#aaa;font-size:10px;font-weight:normal;">
							<br><em><?php echo lang('portfolio.services_tooltip'); ?></em>
						</span></label>
					</label>
					<div class="input"><?php echo form_input('services', htmlspecialchars_decode($project->services), 'maxlength="150" style="width:70%"'); ?></div>
				</li>

				<li>
					<label for="thumb">
						<?php echo lang('portfolio.thumb_label'); ?> 
						<span>*</span>
						<span style="color:#aaa;font-size:11px;font-weight:normal;">
							<br><em><?php echo lang('portfolio.thumb_tooltip'); ?></em>
						</span>
					</label>
					<div class="input"><?php echo form_input('thumb', $project->thumb, 'maxlength="100"'); ?></div>
				</li>

				<li class="even">
					<label for="refurl">
						<?php echo lang('portfolio.refurl_label'); ?> 
					</label>
					<div class="input"><?php echo form_input('refurl', $project->refurl); ?></div>
				</li>

				<li>
					<label for="status"><?php echo lang('portfolio.status_label'); ?><span>*</span></label>
					<div class="input">
						<?php echo form_dropdown('status', array(
								'Draft'=>lang('portfolio.draft_label'), 
								'Live'=>lang('portfolio.live_label')
							), $project->status); 
						?>
					</div>
				</li>

				<li class="even">
					<table>
						<thead>
							<td>
								<label for="overview1">
									<?php echo lang('portfolio.overview1_label'); ?>
									<span style="color:red;">*</span>
								</label>
							</td>
							<td>
								<label for="overview2">
									<?php echo lang('portfolio.overview2_label'); ?>
									<span style="color:red;">*</span>
								</label>
							</td>
						</thead>
						<tbody>
						<tr>
							<td>
								<?php echo form_textarea(array('id' => 'overview1', 'name' => 'overview1', 'value' => htmlspecialchars_decode($project->overview1), 'rows' => 5, 'class' => 'html')); ?>
							</td>
							<td>
								<?php echo form_textarea(array('id' => 'overview2', 'name' => 'overview2', 'value' => htmlspecialchars_decode($project->overview2), 'rows' => 5, 'class' => 'html')); ?>
							</td>
						</tr>
						</tbody>
					</table>
				</li>

				<li class="even editor">
					<label for="screenshots">
						<?php echo lang('portfolio.screenshots_label'); ?>
						<span style="color:#aaa;font-size:10px;font-weight:normal;">
							<br><em><?php echo lang('portfolio.screenshots_tooltip'); ?></em>
						</span>
					</label>
					<br style="clear:both"/>
					<?php echo form_textarea(array('id' => 'screenshots', 'name' => 'screenshots', 'value' => $project->screenshots, 'rows' => 5, 'class' => 'html')); ?>
					
				</li>

			</ul>

		</fieldset>
	</div>

	<div class="buttons float-right padding-top">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel'))); ?>
	</div>

	<?php echo form_close(); ?>

</section>