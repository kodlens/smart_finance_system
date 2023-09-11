<template>
    <div>
        <b-field>
            <b-button class="button is-primary" icon-left="calendar-arrow-right" @click="openModal">New Student</b-button>
        </b-field>


        <b-modal v-model="isModalActive" has-modal-card
                 trap-focus scroll="keep" aria-role="dialog" aria-modal>
            <div class="modal-card" style="width: 760px;">
                <header class="modal-card-head">
                    <p class="modal-card-title">SELECT STUDENT</p>
                    <button type="button" class="delete"
                            @click="isModalActive = false" />
                </header>

                <section class="modal-card-body">
                    <div>

                        <b-field label="Search" label-position="on-border" >
                            
                            <b-input type="text" v-model="search.lname" 
                                placeholder="Search Name..." 
                                expanded auto-focus></b-input>
                            <p class="control">
                                <b-button class="is-primary" 
                                icon-left="text-box-search-outline" 
                                @click="loadAsyncData"></b-button>
                            </p>
                        </b-field>

                        <div class="table-container">
                            <b-table
                                :data='data'
                                :loading="loading"
                                paginated
                                backend-pagination
                                :total='total'
                                :per-page="perPage"
                                @page-change="onPageChange"
                                detail-transition=""
                                aria-next-label="Next page"
                                aria-previous-label="Previouse page"
                                aria-page-label="Page"
                                :show-detail-icon=true
                                aria-current-label="Current page"
                                default-sort-direction="defualtSortDirection"
                                @sort="onSort">

                                <b-table-column field="user_id" label="ID" v-slot="props">
                                    {{props.row.user_id}}
                                </b-table-column>

                                <b-table-column field="name" label="Name" v-slot="props">
                                   {{ props.row.lname }}, {{ props.row.fname }} {{ props.row.mname }}
                                </b-table-column>

                                <b-table-column field="program" label="Program" v-slot="props">
                                    {{props.row.program.program_code}}
                                </b-table-column>

                                <b-table-column field="" label="Action" v-slot="props">
                                    <div class="buttons">
                                        <b-button class="is-small is-info" 
                                            @click="selectData(props.row)"
                                            icon-left="account">SELECT</b-button>
                                    </div>
                                </b-table-column>
                            </b-table>
                        </div>

                    </div>
                </section>

                <footer class="modal-card-foot">
                    <b-button
                        label="Close"
                        @click="isModalActive=false"></b-button>
                </footer>
            </div>
        </b-modal>


    </div>
</template>

<script>
export default {
    props: ['propAcadYearId'],

    data(){
        return{
            data: [],
            total: 0,
            loading: false,
            sortfield: 'user_id',
            sortOrder:'desc',
            page: 1,
            perPage: 5,
            defaultSortDirection:'',

            isModalActive: false,
            errors:{},

            search: {
                lname: '',
                fname: '',
            },


        }
    },
    methods: {
        loadAsyncData() {
            const params = [
                `sort_by=${this.sortfield}.${this.sortOrder}`,
                `lname=${this.search.lname}`,
                `fname=${this.search.fname}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`,
            ].join('&');

            this.loading = true;
            axios.get(`/get-modal-student-lists?${params}`).then(({data}) => {
                this.data = [];
                let currentTotal = data.total;
                if (data.total / this.perPage > 1000) {
                    currentTotal = this.perPage * 1000;
                }

                this.total = currentTotal;
                data.data.forEach((item) => {
                    this.data.push(item);
                });

                this.loading = false;
            }).catch(err => {
                this.data = [];
                this.total = 0;
                this.loading = false;
                throw err;
            });
        },

        onPageChange(page) {
            this.page = page;
            this.loadAsyncData();
        },

        onSort(field, order) {
            this.sortfield = field;
            this.sortOrder = order;
            this.loadAsyncData();
        },

        setPerPage() {
            this.loadAsyncData();
        },

        openModal(){
             this.loadAsyncData();
             this.isModalActive = true;
        },

        selectData(dataRow){
            this.isModalActive = false;
            this.$emit('browseStudents', dataRow);
        },

       

    },


}
</script>

<style scoped>
    .card-width{
        width: 640px;
    }
</style>
