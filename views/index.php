<div class="page-header">
	<div class="container">
		<img alt="Portfolio Header" src="{{variables:uploads}}portfolio-header.png" />
	</div>
</div>
<div class="container">
	<nav id="filter"></nav>
	<section id="container">
		<ul id="stage">
			<?php foreach ($projects as $project): ?>
				<li data-tags="<?php echo $project->category; ?>">
					<a href="portfolio/<?php echo $project->slug; ?>">
						<img src="{{variables:uploads}}<?php echo $project->thumb; ?>" alt="" />
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</section>
</div>
<div class="clear"></div>
<div class="divider-bot40"></div>
<div class="divider-bot40"></div>