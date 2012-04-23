<section class="title">
	<h4><?php echo lang('portfolio.projects'); ?></h4>
</section>

<section class="item">
	
<?php if (!empty($projects)): ?>
	
	<table border="0" class="table-list"> 
		<thead>
			<tr>
				<th><?php echo lang('portfolio.project_label'); ?></th>
				<th><?php echo lang('portfolio.category_label'); ?></th>
				<th><?php echo lang('portfolio.delivered_label'); ?></th>
				<th><?php echo lang('portfolio.addedby_label'); ?></th>
				<th><?php echo lang('portfolio.updated_label'); ?></th>
				<th><?php echo lang('portfolio.status_label'); ?></th>
				<th></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="7">
					<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php foreach ($projects as $project): ?>
				<tr>
					<td><?php echo htmlspecialchars_decode($project->title); ?></td>
					<td class="collapse"><?php echo $project->category; ?></td>
					<td class="collapse"><?php echo $project->delivered_month." ".$project->delivered_year; ?></td>
					<td class="collapse"><?php echo $project->display_name; ?></td>
					<td class="collapse"><?php echo format_date($project->last_updated); ?></td>
					<td class="collapse"><?php echo $project->status; ?></td>
					<td class="actions">
						<?php echo anchor('admin/portfolio/edit/' . $project->id, lang('global:edit'), 'class="button small edit"'); ?>
						<?php echo anchor('admin/portfolio/delete/' . $project->id, lang('global:delete'), array('class'=>'confirm button small')); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>	
	</table>
	
<?php else: ?>
	<div class="no_data"><?php echo lang('portfolio.no_projects');?></div>
<?php endif; ?>
	
</section>