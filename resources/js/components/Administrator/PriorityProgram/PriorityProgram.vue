<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-8">
                    <div class="box">

                        <div class="is-flex is-justify-content-center mb-2" style="font-size: 20px; font-weight: bold;">
                            LIST OF PRIORITY PROGRAMS</div>

                        <div class="level">
                            <div class="level-left">
                                <b-field label="Page">
                                    <b-select v-model="perPage" @input="setPerPage">
                                        <option value="5">5 per page</option>
                                        <option value="10">10 per page</option>
                                        <option value="15">15 per page</option>
                                        <option value="20">20 per page</option>
                                    </b-select>
                                    <b-select v-model="sortOrder" @input="loadAsyncData">
                                        <option value="asc">ASC</option>
                                        <option value="desc">DESC</option>
                                    </b-select>
                                </b-field>
                            </div>

                            <div class="level-right">
                                <div class="level-item">
                                    <b-field label="Search">
                                        <b-input type="text"
                                                 v-model="search.program" placeholder="Search..."
                                                 @keyup.native.enter="loadAsyncData"/>
                                        <p class="control">
                                             <b-tooltip label="Search" type="is-success">
                                            <b-button type="is-primary" icon-right="account-filter" @click="loadAsyncData"/>
                                             </b-tooltip>
                                        </p>
                                    </b-field>
                                </div>
                            </div>
                        </div>

                        <b-table
                            :data="data"
                            :loading="loading"
                            paginated
                            backend-pagination
                            :total="total"
                            :bordered="true"
                            :hoverable="true"
                            :per-page="perPage"
                            @page-change="onPageChange"
                            aria-next-label="Next page"
                            aria-previous-label="Previous page"
                            aria-page-label="Page"
                            aria-current-label="Current page"
                            backend-sorting
                            :default-sort-direction="defaultSortDirection"
                            @sort="onSort">

                            <b-table-column field="priority_program_id" label="ID" v-slot="props">
                                {{ props.row.priority_program_id }}
                            </b-table-column>

                            <b-table-column field="financial_year" label="Financial Year" v-slot="props">
                                {{ props.row.financial_year.financial_year_code }}
                                -
                                {{ props.row.financial_year.financial_year_desc }}
                            </b-table-column>

                            <b-table-column field="priority_program_code" label="Code" v-slot="props">
                                {{ props.row.priority_program_code }}
                            </b-table-column>

                            <b-table-column field="priority_program" label="Priority Program" v-slot="props">
                                {{ props.row.priority_program }}
                            </b-table-column>

                            <b-table-column field="priority_program_budget" label="Budget" v-slot="props">
                                {{ props.row.priority_program_budget }}
                            </b-table-column>

                            <b-table-column label="Action" v-slot="props">
                                <div class="is-flex">
                                    <b-tooltip label="Edit" type="is-warning">
                                        <b-button class="button is-small is-warning mr-1"
                                            tag="a"
                                            icon-right="pencil"
                                            @click="getData(props.row.priority_program_id)"></b-button>
                                    </b-tooltip>
                                    <b-tooltip label="Delete" type="is-danger">
                                        <b-button class="button is-small is-danger mr-1"
                                            icon-right="delete"
                                            @click="confirmDelete(props.row.priority_program_id)"></b-button>
                                    </b-tooltip>
                                </div>
                            </b-table-column>
                        </b-table>

                        <div class="buttons mt-3">
                            <b-button @click="openModal" icon-right="account-arrow-up-outline" class="is-success">NEW</b-button>
                        </div>

                    </div>
                </div><!--col -->
            </div><!-- cols -->
        </div><!--section div-->



        <!--modal create-->
        <b-modal v-model="isModalCreate" has-modal-card
                 trap-focus
                 :width="640"
                 aria-role="dialog"
                 aria-label="Modal"
                 aria-modal>

            <form @submit.prevent="submit">
                <div class="modal-card">
                    <header class="modal-card-head">
                        <p class="modal-card-title">PRIORITY PROGRAM</p>
                        <button
                            type="button"
                            class="delete"
                            @click="isModalCreate = false"/>
                    </header>

                    <section class="modal-card-body">
                        <div class="">

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Financial Year"
                                        expanded
                                        :type="errors.financial_year_id ? 'is-danger':''"
                                        :message="errors.financial_year_id ? errors.financial_year_id[0] : ''">
                                        <b-select v-model="fields.financial_year_id" expanded
                                            required
                                            placeholder="Financial Year">
                                            <option v-for="(item, indx) in financialYears"
                                                :key="`fy${indx}`"
                                                :value="item.financial_year_id">
                                                {{ item.financial_year_code }}
                                                -
                                                {{ item.financial_year_desc }}
                                            </option>
                                        </b-select>
                                    </b-field>
                                </div>
                            </div>
                            <div class="columns">
                                <div class="column">
                                    <b-field label="Priority Program Code" label-position="on-border"
                                        :type="errors.priority_program_code ? 'is-danger':''"
                                        :message="errors.priority_program_code ? errors.priority_program_code[0] : ''">
                                        <b-input v-model="fields.priority_program_code"
                                            placeholder="Priority Program Code" required>
                                        </b-input>
                                    </b-field>
                                </div>

                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Priority Program" label-position="on-border"
                                        :type="errors.priority_program ? 'is-danger':''"
                                        :message="errors.priority_program ? errors.priority_program[0] : ''">
                                        <b-input v-model="fields.priority_program"
                                            placeholder="Priority Program" required>
                                        </b-input>
                                    </b-field>
                                </div>
                            </div>

                            <div class="columns">
                                <div class="column">
                                    <b-field label="Priority Program Budget" label-position="on-border"
                                        :type="errors.priority_program_budget ? 'is-danger':''"
                                        :message="errors.priority_program_budget ? errors.priority_program_budget[0] : ''">
                                        <b-numberinput v-model="fields.priority_program_budget"
                                            controls-alignment="right"
                                            placeholder="Priority Program Budget" required>
                                        </b-numberinput>
                                    </b-field>
                                </div>
                            </div>

                           
                        </div>
                    </section>
                    <footer class="modal-card-foot">

                        <button
                            :class="btnClass"
                            label="Save"
                            type="is-success">SAVE</button>
                    </footer>
                </div>
            </form><!--close form-->
        </b-modal>
        <!--close modal-->


    </div>
</template>

<script>

export default{
    data() {
        return{
            data: [],
            total: 0,
            loading: false,
            sortField: 'priority_program_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 20,
            defaultSortDirection: 'asc',


            global_id : 0,

            search: {
                code: '',
                program: ''
            },

            isModalCreate: false,

            fields: {
                priority_program: '',
                priority_program_code: ''
            },
            errors: {},


            btnClass: {
                'is-success': true,
                'button': true,
                'is-loading':false,
            },

            provinces: [],
            cities: [],
            barangays: [],

            financialYears: [],

        }

    },

    methods: {
        /*
        * Load async data
        */
        loadAsyncData() {
            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `program=${this.search.program}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/get-priority-programs?${params}`)
                .then(({ data }) => {
                    this.data = [];
                    let currentTotal = data.total
                    if (data.total / this.perPage > 1000) {
                        currentTotal = this.perPage * 1000
                    }

                    this.total = currentTotal
                    data.data.forEach((item) => {
                        //item.release_date = item.release_date ? item.release_date.replace(/-/g, '/') : null
                        this.data.push(item)
                    })
                    this.loading = false
                })
                .catch((error) => {
                    this.data = []
                    this.total = 0
                    this.loading = false
                    throw error
                })
        },
        /*
        * Handle page-change event
        */
        onPageChange(page) {
            this.page = page
            this.loadAsyncData()
        },

        onSort(field, order) {
            this.sortField = field
            this.sortOrder = order
            this.loadAsyncData()
        },

        setPerPage(){
            this.loadAsyncData()
        },

        openModal(){
            this.isModalCreate=true;
            this.fields = {};
            this.errors = {};
        },



        submit: function(){

            if(this.global_id > 0){
                //update
                axios.put('/priority-programs/'+this.global_id, this.fields).then(res=>{
                    if(res.data.status === 'updated'){
                        this.$buefy.dialog.alert({
                            title: 'UPDATED!',
                            message: 'Successfully updated.',
                            type: 'is-success',
                            onConfirm: () => {
                                this.loadAsyncData();
                                this.clearFields();
                                this.global_id = 0;
                                this.isModalCreate = false;
                            }
                        })
                    }
                }).catch(err=>{
                    if(err.response.status === 422){
                        this.errors = err.response.data.errors;
                    }
                })
            }else{
                //INSERT HERE
                axios.post('/priority-programs', this.fields).then(res=>{
                    if(res.data.status === 'saved'){
                        this.$buefy.dialog.alert({
                            title: 'SAVED!',
                            message: 'Successfully saved.',
                            type: 'is-success',
                            confirmText: 'OK',
                            onConfirm: () => {
                                this.isModalCreate = false;
                                this.loadAsyncData();
                                this.clearFields();
                                this.global_id = 0;
                            }
                        })
                    }
                }).catch(err=>{
                    if(err.response.status === 422){
                        this.errors = err.response.data.errors;
                    }
                });
            }
        },


        //alert box ask for deletion
        confirmDelete(delete_id) {
            this.$buefy.dialog.confirm({
                title: 'DELETE!',
                type: 'is-danger',
                message: 'Are you sure you want to delete this data?',
                cancelText: 'Cancel',
                confirmText: 'Delete',
                onConfirm: () => this.deleteSubmit(delete_id)
            });
        },
        //execute delete after confirming
        deleteSubmit(delete_id) {
            axios.delete('/priority-programs/' + delete_id).then(res => {
                this.loadAsyncData();
            }).catch(err => {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
            });
        },

        clearFields(){
            this.fields.priority_program = '';
            this.fields.priority_program_code = '';

        },


        //update code here
        getData: function(data_id){
            this.clearFields();
            this.global_id = data_id;
            this.isModalCreate = true;


            //nested axios for getting the address 1 by 1 or request by request
            axios.get('/priority-programs/'+data_id).then(res=>{
                this.fields = res.data;
                
            });
        },

        loadFinancialYears(){
            axios.get('/load-financial-years').then(res=>{
                this.financialYears = res.data
            })
        },


    },

    mounted() {
        this.loadFinancialYears()
        this.loadAsyncData();
    }
}
</script>


<style scoped>
    .modal-card-title{
        font-weight: bold;
    }

</style>
