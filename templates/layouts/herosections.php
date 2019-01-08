<!-- hero name -->
<div class="intro">
    <div class="content-box-s">
        <h1 class="intro-header ab-align-center">
            <?=$hero->getId()?> | <?=$hero->getName()?>
        </h1>
    </div>
</div>

<!-- hero description -->
<div class="section-divider m-wings">
    <div class="hero-description">
        <div class="content-box-xxs">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-1 right">
                        <form class="pure-form" method="post" action="/heroes/view/<?=$hero->getId()?>/previous">
                            <input class="expand-arrow transparent-input" type="submit"/>
                        </form>
                    </div>
                    <div class="col-md-10">
                        <h2 class="head1 blue-heading ab-align-center">
                            <?=$hero->getDescriptionShort()?>
                        </h2>
                    </div>
                    <div class="col-md-1 left">
                        <form class="pure-form" method="post" action="/heroes/view/<?=$hero->getId()?>/next">
                            <input class="expand-arrow transparent-input" type="submit"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container top-spacing-s bottom-spacing-s">
    <div class="row">
        <!-- hero icon -->
        <div class="ab-center-block">
            <div class="hero-icon animate-img">
                <img alt="<?=$hero->getName()?>" src="/img/icons/<?=$hero->getPictureName()?>.png" ondragstart="return false;">
            </div>
        </div>
    </div>
</div>
