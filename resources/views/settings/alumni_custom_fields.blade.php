@extends('layout.app')

@section('page_title', "Alumni Custom fields")

@section('styles')

    <style>
        #app {
            margin: 0 auto;
            width: 80%;
        }
    </style>

@endsection



@section('body')


    <div id="app">
        <div id="modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add Alumni Custom Field</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger "> Once the custom field is added it cannot be deleted later on</p>
                        <div v-if="errors.length > 0" class="alert alert-danger">
                            <ul>
                                <li v-for="error in errors">
                                    @{{ error }}
                                </li>
                            </ul>
                        </div>
                        <form v-on:submit="submit" class="form-horizontal form-label-left">
                            <div class="form-group">
                                <label for="Key Name" class="control-label col-md-3 col-sm-3 col-xs-12">Keye
                                    Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="text" v-model="keyName">
                                </div>
                            </div>
                            <label for="Key Type" class="control-label col-md-3 col-sm-3 col-xs-12">Key Type</label>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select v-model="keyType" class="form-control">
                                        <option disabled value="">Please select one</option>
                                        <option value="text">Text Input</option>
                                        <option value="textarea">Text Area/Textbox</option>
                                    </select>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success pull-right" value="Submit">Save
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <div class="x_panel">
            <div class="x_title">
                <h2>Alumni Custom Fields</h2>
                <button v-on:click="toggleModal" class="btn btn-primary pull-right  btn-lg">Add</button>
                <div class="clearfix"></div>
            </div> <!-- end of x_title -->
            <div class="x_content">
                <div class="col-xs-5">
                    <table class="table table-bordered">
                        <thead>
                        <th>Field</th>
                        <th>Type</th>
                        </thead>
                        <tbody>
                        <tr v-for="customField in alumniCustomFields">
                            <td>@{{ customField.key }}</td>
                            <td>@{{ customField.type }}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

@endsection



@section('scripts')
    {{-- TODO: download --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


    <script>

        $('#modal').modal('hide');


        var app = new Vue({
            el: '#app',
            data: {
                message: 'Hello Vue!',
                alumniCustomFields: [
                    {key: 'hometown', 'type': 'text'},
                    {key: 'numberOfParishioners', 'type': 'text'}
                ],
                keyName: '',
                keyType: 'text',
                errors: []
            },
            methods: {
                fetchCustomFields: function () {
                    axios.get('/api/alumni_custom_fields')
                        .then(response => {
                            // JSON responses are automatically parsed.
                            this.alumniCustomFields = response.data.table_rows;
                        })
                        .catch(e => {
                            alert('Error');
                        })
                },
                toggleModal: function () {
                    $('#modal').modal('show');
                },
                submit: function (e) {

                    e.preventDefault();
                    this.errors = [];

                    if (!this.keyName) {
                        this.errors.push('Name required.');
                        return;
                    }
                    if (!this.keyType) {
                        this.errors.push('Type required.');
                        return;
                    }

                    var that = this;
                    axios.post('/api/alumni_custom_fields', {
                        key: this.keyName,
                        type: this.keyType
                    })
                        .then(function (response) {
                            if (response.data.status && response.data.status === 'error') {
                                that.errors = response.data.errors;
                            } else {
                                /**
                                 * Update UI
                                 */
                                that.fetchCustomFields();
                                $('#modal').modal('hide');
                            }


                        })
                        .catch(function (error) {
                            console.log(error);
                        });

                }
            },


        });
        app.fetchCustomFields();

        // $('#myModal').on('hidden.bs.modal', function () {
        //     // do something…
        // })

    </script>

@endsection