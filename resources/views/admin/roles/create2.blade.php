<div class="content">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">
                Create Role </h3>
        </div>
        <div class="card-body">

            <div class="roles-form">

                <form id="w0" action="/admin/roles/create" method="post">
                    <input type="hidden" name="_csrf"
                        value="37_lXq7f-LPvZX1Fr1gvxH9FreliqgddcH9dQtcCeqWR-Zw67ZS92J4DPgfhHh-BDDz9iFPNdy4bOjwBkVMllg==">
                    <div class="form-group field-roles-rol_name required has-error">
                        <label class="control-label" for="roles-rol_name">Role Name</label>
                        <input type="text" id="roles-rol_name" class="form-control" name="Roles[rol_name]"
                            maxlength="255" aria-required="true" aria-invalid="true">

                        <div class="help-block">Role Name cannot be blank.</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-29">
                                <label class="control-label" for="roles-permissions-29">Assign Tickets</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][29]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-29 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-29" class="form-control"
                                                name="Roles[permissions][29]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-10">
                                <label class="control-label" for="roles-permissions-10">Bulk SMS Delete</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][10]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-10 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-10" class="form-control"
                                                name="Roles[permissions][10]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-8">
                                <label class="control-label" for="roles-permissions-8">Bulk SMS Send/Update/Add</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][8]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-8 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-8" class="form-control"
                                                name="Roles[permissions][8]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-9">
                                <label class="control-label" for="roles-permissions-9">Bulk SMS View</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][9]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-9 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-9" class="form-control"
                                                name="Roles[permissions][9]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-26">
                                <label class="control-label" for="roles-permissions-26">Calendar Management</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][26]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-26 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-26" class="form-control"
                                                name="Roles[permissions][26]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-4">
                                <label class="control-label" for="roles-permissions-4">Contacts
                                    Add/Update/Upload</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][4]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-4 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-4" class="form-control"
                                                name="Roles[permissions][4]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-7">
                                <label class="control-label" for="roles-permissions-7">Contacts Delete</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][7]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-7 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-7" class="form-control"
                                                name="Roles[permissions][7]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-5">
                                <label class="control-label" for="roles-permissions-5">Contacts Export</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][5]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-5 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-5" class="form-control"
                                                name="Roles[permissions][5]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-6">
                                <label class="control-label" for="roles-permissions-6">Contacts View</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][6]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-6 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-6" class="form-control"
                                                name="Roles[permissions][6]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-23">
                                <label class="control-label" for="roles-permissions-23">Election Results
                                    Tallying</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][23]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-23 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-23" class="form-control"
                                                name="Roles[permissions][23]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-24">
                                <label class="control-label" for="roles-permissions-24">Election Results View</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][24]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-24 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-24" class="form-control"
                                                name="Roles[permissions][24]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-20">
                                <label class="control-label" for="roles-permissions-20">Election Vacancies and
                                    Candidates Add/Update</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][20]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-20 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-20" class="form-control"
                                                name="Roles[permissions][20]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-22">
                                <label class="control-label" for="roles-permissions-22">Election Vacancies and
                                    Candidates Delete</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][22]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-22 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-22" class="form-control"
                                                name="Roles[permissions][22]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-21">
                                <label class="control-label" for="roles-permissions-21">Election Vacancies and
                                    Candidates View</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][21]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-21 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-21" class="form-control"
                                                name="Roles[permissions][21]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-17">
                                <label class="control-label" for="roles-permissions-17">Elective Positions
                                    Add/Update</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][17]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-17 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-17" class="form-control"
                                                name="Roles[permissions][17]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-19">
                                <label class="control-label" for="roles-permissions-19">Elective Positions
                                    Delete</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][19]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-19 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-19" class="form-control"
                                                name="Roles[permissions][19]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-18">
                                <label class="control-label" for="roles-permissions-18">Elective Positions
                                    View</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][18]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-18 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-18" class="form-control"
                                                name="Roles[permissions][18]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-1">
                                <label class="control-label" for="roles-permissions-1">Locations Add/Update</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][1]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-1 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-1" class="form-control"
                                                name="Roles[permissions][1]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-3">
                                <label class="control-label" for="roles-permissions-3">Locations Delete</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][3]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-3 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-3" class="form-control"
                                                name="Roles[permissions][3]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-2">
                                <label class="control-label" for="roles-permissions-2">Locations View</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][2]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-2 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-2" class="form-control"
                                                name="Roles[permissions][2]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-30">
                                <label class="control-label" for="roles-permissions-30">Manage Departments</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][30]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-30 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-30" class="form-control"
                                                name="Roles[permissions][30]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-31">
                                <label class="control-label" for="roles-permissions-31">Manage Staff</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][31]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-31 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-31" class="form-control"
                                                name="Roles[permissions][31]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-14">
                                <label class="control-label" for="roles-permissions-14">Political Parties
                                    Add/Update</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][14]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-14 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-14" class="form-control"
                                                name="Roles[permissions][14]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-16">
                                <label class="control-label" for="roles-permissions-16">Political Parties
                                    Delete</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][16]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-16 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-16" class="form-control"
                                                name="Roles[permissions][16]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-15">
                                <label class="control-label" for="roles-permissions-15">Political Parties View</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][15]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-15 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-15" class="form-control"
                                                name="Roles[permissions][15]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-11">
                                <label class="control-label" for="roles-permissions-11">Politicians Add/Update</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][11]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-11 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-11" class="form-control"
                                                name="Roles[permissions][11]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-13">
                                <label class="control-label" for="roles-permissions-13">Politicians Delete</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][13]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-13 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-13" class="form-control"
                                                name="Roles[permissions][13]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-12">
                                <label class="control-label" for="roles-permissions-12">Politicians View</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][12]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-12 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-12" class="form-control"
                                                name="Roles[permissions][12]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-28">
                                <label class="control-label" for="roles-permissions-28">System Management</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][28]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-28 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-28" class="form-control"
                                                name="Roles[permissions][28]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-25">
                                <label class="control-label" for="roles-permissions-25">Tickets Management</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][25]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-25 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-25" class="form-control"
                                                name="Roles[permissions][25]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group field-roles-permissions-27">
                                <label class="control-label" for="roles-permissions-27">User Management</label>
                                <div class="form-group"><input type="hidden" name="Roles[permissions][27]"
                                        value="0">
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-off bootstrap-switch-id-roles-permissions-27 bootstrap-switch-animate"
                                        style="width: 77.2188px;">
                                        <div class="bootstrap-switch-container"
                                            style="width: 112.828px; margin-left: -37.6094px;"><span
                                                class="bootstrap-switch-handle-on bootstrap-switch-primary"
                                                style="width: 37.6094px;">Yes</span><span
                                                class="bootstrap-switch-label"
                                                style="width: 37.6094px;">&nbsp;</span><span
                                                class="bootstrap-switch-handle-off bootstrap-switch-default"
                                                style="width: 37.6094px;">No</span><input type="checkbox"
                                                id="roles-permissions-27" class="form-control"
                                                name="Roles[permissions][27]" value="1"
                                                data-krajee-bootstrapswitch="bootstrapSwitch_8eaf19f3"></div>
                                    </div>
                                </div>


                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
