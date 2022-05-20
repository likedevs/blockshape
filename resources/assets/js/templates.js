var templates = angular.module('templates', []);
templates.run(['$templateCache', function($templateCache) {
    $templateCache.put('cancel-order.html',
        '<md-bottom-sheet class="md-list md-has-header" ng-cloak>' +
        '   <md-subheader>Anulare comandă</md-subheader>' +
        '   <md-list>' +
        '       <md-list-item>' +
        '           <md-button flex ng-click="closeSheet()" class="md-list-item-content md-raised md-default">' +
        '               <md-icon>check</md-icon>' +
        '               Vreau să continui' +
        '           </md-button>' +
        '       </md-list-item>' +
        '       <md-list-item>' +
        '           <md-button flex ng-click="confirm()" class="md-list-item-content md-raised md-warn">' +
        '               <md-icon>close</md-icon>' +
        '               Vreau să anulez' +
        '           </md-button>' +
        '       </md-list-item>' +
        '       <md-list-item>&nbsp;</md-list-item>' +
        '   </md-list>' +
        '</md-bottom-sheet>'
    );

    $templateCache.put('schedule-day.html',
        '<div layout-padding>' +
        '   <div layout="column">' +
        '       <div layout="row">' +
        '           <span class="md-display-2" ng-class="{\'required\': ! isValid()}">{{ weekday }}</span>' +
        '           <md-select flex="10" placeholder="{{ hour }}" style="margin: 0 10px;" ng-required="isActivityDay()" class="md-mini" ng-show="isActivityDay()" ng-model="time" aria-label="Workout time">' +
        '               <md-option ng-value="ts" ng-repeat="ts in workouts">{{ ts }}</md-option>' +
        '           </md-select>' +
        '           <span flex></span>' +
        '       </div>' +
        '       <div layout="row">' +
        '           <md-button aria-label="Zi de antrenament" ng-click="setType(\'activity\')" class="md-raised" ng-class="{\' md-primary\': isActivityDay(), \'btn-left\': largeDevice}">' +
        '               <md-icon>directions_run</md-icon> Zi de antrenament' +
        '           </md-button>' +
        '           <md-button aria-label="Zi de odihna" ng-click="setType(\'rest\')" class="md-raised" ng-class="{\'md-primary\': isRestDay(), \'btn-middle\': largeDevice}">' +
        '               <md-icon>restore</md-icon> Zi fără antrenament' +
        '           </md-button>' +
        '           <md-button aria-label="Zi de detoxifiere" ng-click="setType(\'discharging\')" class="md-raised" ng-class="{\'md-primary\': isDetoxDay(), \'btn-right\': largeDevice}">' +
        '               <md-icon>radio_button_unchecked</md-icon> Zi de detoxifiere' +
        '           </md-button>' +
        '       </div>' +
        '   </div>' +
        '   <md-divider></md-divider>' +
        '</div>'
    );
}]);
