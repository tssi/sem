<div class="navbar navbar-default navbar-fixed-top" id="navbar-toggle" ng-class="{'blur': __MODAL_OPEN}">
    <button type="button" class=" navbar-toggle c-hamburger c-hamburger--htx fade out"  ng-class="{'in':__APP_READY}" id="menu-toggle-1"  ng-click="__toggleSideBar()">
        <span>Toggle Menu</span>
    </button>
    <a class="navbar-brand fade out"  ng-class="{'in':__FAB_READY}">{{__MODULE_NAME}}</a>
    <div class="loader fade in" ng-class="{'out':__APP_READY,'in':!__APP_READY}"></div>
</div>