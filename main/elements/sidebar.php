<div class="sidebar-blind ease">
    <div class="btn-group btn-sm" ng-if="__SIDEBAR_OPEN"> 
        <button class="btn btn-reverse">Today</button>
        <button class="btn btn-reverse">Notifications</button>
    </div>
</div>
<!-- Sidebar -->
<div id="sidebar-wrapper" class="ease">
    <div class="navbar navbar-default" id="offcanvas-navbar-toggle">
        <button type="button" class="navbar-toggle c-hamburger c-hamburger--htx" ng-class="{'is-active':__SIDEBAR_OPEN}" id="menu-toggle-1" ng-click="__toggleSideBar()" >
            <span>Toggle Menu</span>
        </button>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <div id="user-name">Mabuhay!</div>
            <div id="company-name">{{__USER.user.username}}</div>
        </li>
        <li class="separator">
        </li>
            <li>
            <a href="/app" ng-click="__toggleSideBar()">App</a>
        </li>
        <li>
            <a href="#/" ng-click="__toggleSideBar()">Home</a>
        </li>
        <!-- <li>
            <a href="#/students/index" ng-click="__toggleSideBar()">Inquiry</a>
        </li>
        <li>
            <a href="#/students/college" ng-click="__toggleSideBar()">College Inquiry</a>
        </li>
        <li>
            <a href="#/assesments/index" ng-click="__toggleSideBar()">Assesment</a>
        </li>
        <li>
            <a href="#/assesments/college" ng-click="__toggleSideBar()">College Assesment</a>
        </li>
        <li>
            <a href="#tuitions/index" ng-click="__toggleSideBar()">Tuition Structure</a>
        </li>
        <li>
            <a href="#/maintenance/list" ng-click="__toggleSideBar()">List Maintenance</a>
        </li> -->
        <li ng-repeat="Menu in __SIDEBAR_MENUS">
            <a ng-if="!Menu.is_parent" href="#/{{Menu.link}}" ng-click="__toggleSideBar()">
                {{ Menu.name}}
                
            </a>
            <a ng-if="Menu.is_parent && Menu.is_granted" class="accordion-toggle collapsed toggle-switch" data-toggle="collapse" ng-class="{active:ActiveMenu==Menu.id}" ng-click="__toggleSubMenu(Menu)">
                <b class="caret"></b>
                <span class="sidebar-title">{{Menu.name}}</span>
                
            </a>
            <ul ng-if="Menu.is_parent && Menu.is_granted" ng-class="{in:ActiveMenu==Menu.id}" class="panel-collapse collapse panel-switch" role="menu">
                <li class="separator"></li>
                <li ng-repeat="Submenu in Menu.children">
                    <a href="#/{{Submenu.link}}" ng-click="__loadModule(Submenu)">{{Submenu.name}}</a>
                </li>
                <li class="separator"></li>
            </ul>
        </li>
        <li>
            <a href="#/logout">
            <span class="sidebar-title">
                    <span class="glyphicon glyphicon-off"></span>
                    Logout
            </span>
            </a>
        </li>
    </ul>
    <div id="app-version">SEM <?php echo $versionNo;?></div>
</div>
<!-- /#sidebar-wrapper -->