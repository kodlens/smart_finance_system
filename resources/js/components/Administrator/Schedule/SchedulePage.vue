<template>
    <div>
        <div class="is-flex is-justify-content-center mb-4" style="font-size: 20px; font-weight: bold;">SCHEDULES</div>
        
        <div class="columns">
            <div class="column">
                <b-field label="Academic Year" label-position="on-border">
                    <b-select v-model="search.academic_year_id">
                        <option v-for="(item, ix) in acadYears"
                            :key="ix" 
                            :value="item.academic_year_id">{{ item.academic_year_code }} - {{ item.academic_year_desc }}</option>
                    </b-select>
                </b-field>
            </div>
            
        </div>

        <div class="columns">
            <div class="column">
                <b-field label="Page" label-position="on-border">
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

            <div class="column">
                <b-field label="Search" label-position="on-border" class="is-pulled-right">
                    <b-input type="text"
                        v-model="search.office" placeholder="Search Schedule"
                        @keyup.native.enter="loadAsyncData"/>
                    <p class="control">
                        <b-tooltip label="Search" type="is-success">
                            <b-button type="is-primary" icon-right="account-filter" @click="loadAsyncData"/>
                        </b-tooltip>
                    </p>
                </b-field>
            </div>
        </div>
        

        <b-table
            :data="data"
            :loading="loading"
            paginated
            :bordered="true"
            :hoverable="true"
            backend-pagination
            :total="total"
            :per-page="perPage"
            @page-change="onPageChange"
            aria-next-label="Next page"
            aria-previous-label="Previous page"
            aria-page-label="Page"
            aria-current-label="Current page"
            backend-sorting
            :default-sort-direction="defaultSortDirection"
            @sort="onSort">

            <b-table-column field="schedule_id" label="ID" v-slot="props">
                {{ props.row.schedule_id }}
            </b-table-column>

            <b-table-column field="course" label="Course" v-slot="props">
                {{ props.row.course.course_code }} {{ props.row.course.course_desc}}
            </b-table-column>

            <b-table-column field="type" label="Type" v-slot="props">
                {{ props.row.course.course_type }}
            </b-table-column>

            <b-table-column field="unit" label="Unit" v-slot="props">
                {{ props.row.course.course_unit }}
            </b-table-column>

            <b-table-column field="created_at" label="Schedule" v-slot="props">
                {{ props.row.start_time | formatTime }} - {{ props.row.end_time | formatTime }}
            </b-table-column>

             <b-table-column field="created_at" label="Schedule" v-slot="props">
                <span v-if="props.row.mon">M</span>
                <span v-if="props.row.tue">T</span>
                <span v-if="props.row.wed">W</span>
                <span v-if="props.row.thu">TH</span>
                <span v-if="props.row.fri">F</span>
                <span v-if="props.row.sat">SAT</span>
                <span v-if="props.row.sun">SUN</span>
            </b-table-column>

            
            <b-table-column label="Action" v-slot="props">
                <div class="is-flex">
                    <b-tooltip label="Edit" type="is-warning">
                        <b-button class="button is-small is-warning mr-1" tag="a" icon-right="pencil"
                            :href="`/schedules/${props.row.schedule_id}/edit`"></b-button>
                    </b-tooltip>
                    <b-tooltip label="Delete" type="is-danger">
                        <b-button class="button is-small is-danger mr-1" icon-right="delete" @click="confirmDelete(props.row.office_id)"></b-button>
                    </b-tooltip>
                </div>
            </b-table-column>
        </b-table>

        <div class="float-button">
            <b-button tag="a" href="/schedules/create"
                icon-right="plus-circle-outline" 
                class="is-success"
                label="NEW SCHEDULE">
            </b-button>
        </div>

    </div> <!--root div-->
</template>

<script>

export default{
    data() {
        return{
            data: [],
            total: 0,
            loading: false,
            sortField: 'schedule_id',
            sortOrder: 'desc',
            page: 1,
            perPage: 20,
            defaultSortDirection: 'asc',


            acadYears : [],

            search: {
                academic_year_id: null
            },

            isModalCreate: false,


            btnClass: {
                'is-success': true,
                'button': true,
                'is-loading':false,
            },

        }

    },

    methods: {
        /*
        * Load async data
        */
        loadAsyncData() {
            const params = [
                `sort_by=${this.sortField}.${this.sortOrder}`,
                `acadyearid=${this.search.academic_year_id}`,
                `perpage=${this.perPage}`,
                `page=${this.page}`
            ].join('&')

            this.loading = true
            axios.get(`/get-schedules?${params}`)
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
            axios.delete('/offices/' + delete_id).then(res => {
                this.loadAsyncData();
            }).catch(err => {
                if (err.response.status === 422) {
                    this.errors = err.response.data.errors;
                }
            });
        },

        loadAcademicYears(){
            axios.get('/load-acadyears').then(res=>{
                this.acadYears = res.data
                this.search.academic_year_id = (this.acadYears.filter(item => item.active === 1)[0].academic_year_id)

                this.loadAsyncData();
            })
        }
    },

    mounted() {
       // this.loadAsyncData();
        this.loadAcademicYears()
    }
}
</script>


<style>


</style>
