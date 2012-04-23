<div class="page-header">
	<div class="container">
		<img alt="Portfolio Header" src="{{variables:uploads}}portfolio-header.png" />
	</div>
</div>
<div class="container">
	<div class="backlink"> {{ url:anchor segments="portfolio" title="back to portfolio" }}</div>
	<div class="hr title-big"><?php echo $project->title; ?> ( <?php echo $project->category; ?> )
	<?php if (!empty($project->refurl)): ?>
		<div class="launch_link"><?php echo anchor($project->refurl,lang('portfolio.launch_label'), 'target=_blank'); ?></div>
	<?php endif; ?>
	</div>
	<div class="work-desc-holder">
		<div class="workblock1"><div class="title"><?php echo lang('portfolio.overview_label'); ?></div></div>
		<div class="workblock2"><?php echo $project->overview1; ?></div>
		<div class="workblock2"><?php echo $project->overview2; ?></div>
	</div>
	<div class="clear hr"></div>
	<div class="work-services-holder">
		<div class="workblock1 collapse"><div class="title"><?php echo lang('portfolio.services_label'); ?></div></div>
		<div class="workblock3"><?php echo $project->services; ?></div>
	</div>
	<div class="clear hr divider-bot15"></div>
	<?php if (!empty($project->screenshots)): ?>
		<div class="work-screenshots-holder">
			<div class="workblock4"><?php echo $project->screenshots; ?></div>
		</div>
		<div class="clear hr divider-bot15"></div>
	<?php endif; ?>
</div>
<div class="divider-bot40"></div>