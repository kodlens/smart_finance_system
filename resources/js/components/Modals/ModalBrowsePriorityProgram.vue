<template>
    <div>
        <b-field>
            <b-input :value="valueName" expanded
                 icon="format-list-checkbox"
                 placeholder="Select Priority Program"
                 required readonly>
            </b-input>

            <p class="control">
                <b-button class="button is-primary" @click="openModal">...</b-button>
            </p>
        </b-field>


        <b-modal v-model="isModalActive" has-modal-card
                 trap-focus scroll="keep" aria-role="dialog" aria-modal>
            <div class="modal-card card-width">
                <header class="modal-card-head">
                    <p class="modal-card-title">SELECT</p>
                    <button type="button" class="delete"
                            @click="isModalActive = false" />

                </header>

                <section class="modal-card-body">
                    <div>
                        <b-field label="Search..." label-position="on-border" >
                            <b-input type="text"
                                v-model="search.pp"
                                placeholder="Search Priority Program..."
                                @keyup.native.enter="loadAsyncData"
                                expanded auto-focus></b-input>

                            <b-input type="text"
                                 v-model="search.code"
                                 placeholder="Search Priority Program Code..."
                                 @keyup.native.enter="loadAsyncData"
                                 expanded auto-focus></b-input>
                            <p class="control">
                                <b-button class="is-primary" icon-left="magnify" @click="loadAsyncData"></b-button>
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

                                <b-table-column field="priority_program_id" label="ID" v-slot="props">
                                    {{props.row.priority_program_id}}
                                </b-table-column>

                                <b-table-column field="priority_program" label="Priority Program" v-slot="props">
                                    {{ props.row.priority_program }}
                                </b-table-column>

                                <b-table-column field="allotment_class_account_code" label="Priority Program Code" v-slot="props">
                                    {{ props.row.priority_program_code }}
                                </b-table-column>


                                <b-table-column field="" label="Action" v-slot="props">
                                    <div class="buttons">
                                        <b-button class="is-small is-warning" @click="selectData(props.row)">
                                            <i class="fa fa-pencil"></i>&nbsp;&nbsp;SELECT</b-button>
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
    props: {
        propPriorityProgram: {
            type: String,
            default: '',
        },

  

    },


    data(){
        return{
            data: [],
            total: 0,
            loading: false,
            sortField: 'priority_program_id',
            sortOrder:'desc',
            page: 1,
            perPage: 5,
            defaultSortDirection:'',

            isModalActive: false,
            errors:{},


            search: {
                pp: '',
                code: '',
            },
        }
    },
    methods: {
        loadAsyncData() {
            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `pp=${this.search.pp}`,
                `code=${this.search.code}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/get-modal-priority-programs?${params}`)
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
            this.$emit('browsePriorityProgram', dataRow);
        }

    },

    computed: {
        valueName(){
            return this.propPriorityProgram;
        },




    },

}
</script>

<style scoped>
.card-width{
    width: 640px;
}
</style>
