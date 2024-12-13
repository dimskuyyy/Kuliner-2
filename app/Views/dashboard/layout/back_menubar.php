<?php $request = service('request');
$permadmin = 1;
$permmember = 2;
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url() ?>/back/img/avatar.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= AuthUser()->nama; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu tree" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?= $request->getUri()->getSegment(2) === "" ? 'active' : ''; ?>">
                <a href="<?php echo base_url('wbpanel'); ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="<?= $request->getUri()->getSegment(2) === "media" ? 'active' : ''; ?>">
                <a href="<?php echo base_url('wbpanel/media'); ?>">
                    <i class="fa fa-folder-open"></i> <span>Media</span>
                </a>
            </li>
            <?php if (AuthUser()->level == 1) { ?>
                <li class="<?= $request->getUri()->getSegment(2) === "membership" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/membership'); ?>">
                        <i class="fa fa-users"></i> <span>Membership</span>
                    </a>
                </li>
                <li class="<?= $request->getUri()->getSegment(2) === "user" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/user'); ?>">
                        <i class="fa fa-user"></i> <span>User</span>
                    </a>
                </li>
            <?php } ?>
            <?php if (AuthUser()->level == 2) { ?>
                <li class="<?= $request->getUri()->getSegment(2) === "kuliner" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/kuliner'); ?>">
                        <i class="fa fa-users"></i> <span>Kuliner</span>
                    </a>
                </li>        
                <li class="<?= $request->getUri()->getSegment(2) === "galeri" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/galeri'); ?>">
                        <i class="fa fa-users"></i> <span>Galeri Kuliner</span>
                    </a>
                </li>        
                <li class="<?= $request->getUri()->getSegment(2) === "menu" ? 'active' : ''; ?>">
                    <a href="<?php echo base_url('wbpanel/menu'); ?>">
                        <i class="fa fa-users"></i> <span>Menu Kuliner</span>
                    </a>
                </li>        
            <?php } ?>
        </ul>
    </section>
</aside>