<div style="left: 30%;position: absolute;width: 40%">
<header class="w3-container w3-light-grey w3-padding-16">
    <h3>ToDo-list</h3>
</header>
<ul class="w3-ul">
    <li ng-repeat="x in toDoList" class="w3-padding-16">
        <span ng-bind="x.title"></span>
        <span ng-show="x.checked" ng-bind="'| Details:' + x.details"></span>
        <div class="btn btn-group" style="float: right">
            <input type="checkbox" ng-model="check" ng-change="showDetails(check, x.id)">
            <button class="glyphicon glyphicon-pencil" data-toggle="modal" data-target="#edit" ng-click="editToDo(x)"></button>
        </div>

    </li>
</ul>
<div class="w3-container w3-light-grey w3-padding-16">
    <div class="w3-row w3-margin-top">
        <div class="w3-col s10">
            <input placeholder="ToDo-Titel" ng-model="addMeTitle" class="w3-input w3-border w3-padding">
            <input placeholder="ToDo-Details" ng-model="addMeDetails" class="w3-input w3-border w3-padding">
        </div>
        <div class="w3-col s2">
            <button ng-click="addItem(addMeTitle,addMeDetails)" class="w3-btn w3-padding w3-green">Add</button>
        </div>
    </div>
    <button type="button" style="float: right" class="btn btn-primary btn-lg" data-dismiss="modal" ng-click="save()">Save</button>
    <div class="well">
        <div show-more>
            {{ hello }}
        </div>
    </div>
    <p class="w3-padding-left w3-text-red">{{errortext}}</p>
</div>
    <div class="modal fade" id="edit" role="dialog">
        <div class="modal-dialog" style="z-index: 99999;">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Objekt Attribute ändern</h4>
                </div>
                <div class="modal-body">
                    <div>
                        <label>Titel:</label>
                        <input ng-value="actToDo.title" ng-model="newToDoTitel">
                        <label>Details:</label>
                        <input ng-value="actToDo.details" ng-model="newToDoDetails">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary btn-s" data-dismiss="modal" ng-click="refactor(newToDoTitel,newToDoDetails)">Übernehmen</button>
                        <button type="button" class="btn btn-primary btn-s" data-dismiss="modal">Abbrechen</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>