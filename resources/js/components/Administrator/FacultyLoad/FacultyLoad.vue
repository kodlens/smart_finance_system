<template>
    <div>
        <div class="section">
            <div class="columns is-centered">
                <div class="column is-10">
                    <div class="box">
                        <div class="has-text-weight-bold">MANAGE FACULTY LOAD</div>
                        <br>
                        <b-field label="Academic Year" label-position="on-border">
                            <b-select v-model="acadYear" @input="loadFacultyLoads">
                                <option v-for="(item, ixx) in acadYears" :key="ixx" :value="item.academic_year_id">
                                    {{ item.academic_year_code }} - {{ item.academic_year_desc }}
                                </option>
                            </b-select>
                        </b-field>
                        <div class="has-text-bold">
                            Name: 
                            <span>{{ this.user.lname }}, {{ this.user.fname }} {{ this.user.mname }}</span>
                        </div>
                        <div class="has-text-bold">
                            Sex: 
                            <span>{{ this.user.sex }}</span>
                        </div> 

                        <div class="table-faculty-load">
                            <div class="faculty-body">
                                <div class="buttons mt-4">
                                    <modal-browse-schedules
                                        :prop-acad-year-id="acadYear"
                                        @browseSchedule="emitBrowseSchedule"></modal-browse-schedules>
                                </div>
                                <table class="table-courses">
                                    <b-loading v-model="isLoading"></b-loading>
                                    <tr>
                                        <th>ID</th>
                                        <th>Code</th>
                                        <th>Description</th>
                                        <th>Type/Unit</th>
                                        <th>Schedule</th>
                                        <th>Day</th>
                                        <th>Room</th>
                                        <th>Action</th>
                                    </tr>

                                    <tr v-for="(item, ix) in facultyLoads" :key="ix">
                                        <td>{{ item.schedule_id }}</td>
                                        <td>{{ item.course_code }}</td>
                                        <td>{{ item.course_desc }}</td>
                                        <td>{{ item.course_type }} ({{ item.course_unit }})</td>
                                        <td>{{ item.start_time | formatTime }} - {{ item.end_time | formatTime }}</td>
                                        <td>
                                            <span v-if="item.mon">M</span>
                                            <span v-if="item.tue">T</span>
                                            <span v-if="item.wed">W</span>
                                            <span v-if="item.thu">TH</span>
                                            <span v-if="item.fri">F</span>
                                            <span v-if="item.sat">SAT</span>
                                            <span v-if="item.sun">SUN</span>
                                        </td>
                                        <td>{{ item.room }}</td>
                                        <td>
                                            <b-button type="is-danger" 
                                            @click="removeLoad(item.faculty_load_id, ix)"
                                            icon-left="delete" class="is-small is-outlined"></b-button>
                                        </td>

                                    </tr>
                                </table>
                                <hr>
                                <div class="buttons is-right m-4">
                                    <b-button class="is-info is-outlined"
                                        @click="submit"
                                        label="Save"></b-button>
                                </div>
                            </div><!--faculty body -->

                        </div>
                        
                    </div>
                </div><!--col -->
            </div><!-- cols -->
        </div><!--section div-->


    </div>
</template>

<script>

export default{

    props: ['propUser', 'propAcadYears'],
    data() {

        return{
            user: {},
            acadYears: [],
            acadYear: null,

            facultyLoads: [],

            isLoading: false,
        }

    },

    methods: {
       
        initData(){
            this.user = JSON.parse(this.propUser)
            this.acadYears = JSON.parse(this.propAcadYears)

        },

        loadFacultyLoads(){
            
            axios.get('/get-individual-loads/' + this.user.user_id + '/' + this.acadYear).then(res=>{
                this.facultyLoads = [];
                console.log('res data', res.data)
                res.data.forEach(el => {
                    this.facultyLoads.push({
                        faculty_load_id: el.faculty_load_id,
                        academic_year_id: this.acadYear,
                        schedule_id: el.schedule_id,
                        course_id: el.schedule.course_id,
                        course_code: el.schedule.course.course_code,
                        course_desc: el.schedule.course.course_desc,
                        course_type: el.schedule.course.course_type,
                        course_unit: el.schedule.course.course_unit,
                        start_time: el.schedule.start_time,
                        end_time: el.schedule.end_time,
                        room_id: el.schedule.room.room_id,
                        room: el.schedule.room.room,
                        mon: el.schedule.mon,
                        tue: el.schedule.tue,
                        wed: el.schedule.wed,
                        thu: el.schedule.thu,
                        fri: el.schedule.fri,
                        sat: el.schedule.sat,
                        sun: el.schedule.sun
                    })
                });

            }).catch(err=>{
            
            })
        },


        removeLoad(id, ix){
            this.$buefy.dialog.confirm({
                title: 'Delete?',
                message: 'Are you sure you want to remove this load?',
                type: 'is-danger',
                onConfirm: ()=>{

                    if(id > 0){
                        axios.delete('/faculty-load-delete/' + id).then(res=>{
                            if(res.data.status === 'deleted'){
                                this.$buefy.dialog.alert({
                                    title: 'Deleted.',
                                    message: 'Deleted successfully.',
                                    type: 'is-info'
                                });
                                this.loadFacultyLoads();
                            };
                        })
                    }else{
                        this.facultyLoads.splice(ix, 1);
                    }

                }
            })

        },

        emitBrowseSchedule(row){
            console.log(row)
            // avoid double select from schedule list
            let flag = false;
            let id = row.schedule_id;
            this.facultyLoads.forEach(el=>{
                if(id === el.schedule_id){
                    flag = true;
                }
            });
            //avoid double select from schedule list

            if(!flag){
                this.facultyLoads.push({
                    faculty_load_id: 0,
                    academic_year_id: this.acadYear,
                    schedule_id: row.schedule_id,
                    course_id: row.course_id,
                    course_code: row.course.course_code,
                    course_desc: row.course.course_desc,
                    course_type: row.course.course_type,
                    course_unit: row.course.course_unit,
                    start_time: row.start_time,
                    end_time: row.end_time,
                    room_id: row.room_id,
                    mon: row.mon,
                    tue: row.tue,
                    wed: row.wed,
                    thu: row.thu,
                    fri: row.fri,
                    sat: row.sat,
                    sun: row.sun
                })
            }else{
                this.$buefy.dialog.alert({
                    title: 'Existed!',
                    message: 'Schedule already added.',
                    type: 'is-info',
                })
            }
        },

        submit(){
            this.isLoading = true
            let facultyLoad = {
                user_id: this.user.user_id,
                loads: this.facultyLoads
            }

            axios.post('/faculty-load-store', facultyLoad).then(res=>{
                console.log(res.data)
                this.isLoading = false
                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: 'SAVED.',
                        message: 'Successfully saved.',
                        type: 'is-success',
                        onConfirm: () => {
                            this.facultyLoad = {}; //clear obj
                            this.facultyLoads = []; //clear array loads

                            this.loadFacultyLoads();
                        }
                    })
                }

                //this.facultyLoads = [];
            }).catch(err=>{
                //this.facultyLoads = [];
                this.isLoading = false
            })
        },
    },

    mounted() {
        this.initData()
       
    }
}
</script>


<style>

    .table-faculty-load{
        margin: 10px 0;
        border: 1px solid #e2e2e2;
    }
    .faculty-body{
        padding: 5px;
    }
    .table-courses{
        margin: 10px;
    }
    .table-courses tr th, .table-courses tr td{
        padding: 5px 10px;
    }

</style>
