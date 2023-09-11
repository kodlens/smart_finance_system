<template>
    <div>
        <div>
            <p class="has-text-weight-bold mb-4 has-text-centered title is-5">FACULTY LOAD</p>
        </div>

        <div class="columns">
            <div class="column">
                <b-field label="Select Academic Year">
                    <b-select v-model="acadYearId">
                        <option v-for="(item, ix) in acadYears" :key="ix"
                            :value="item.academic_year_id">{{ item.academic_year_code }} - {{ item.academic_year_desc }}</option>
                    </b-select>

                    <p class="control">
                        <b-button @click="loadFacultyLoads"
                            label="" icon-left="magnify" type="is-info"></b-button>
                    </p>
                </b-field>
            </div>
        </div>
        <hr>
        <div class="columns">
            <div class="column">
                <table class="faculty-load">
                    <tr>
                        <th>ID</th>
                        <th>Course</th>
                        <th>Schedule</th>
                        <th>Day</th>
                        <th>Room</th>
                        <th>Action</th>
                    </tr>

                    <tr v-for="(item, idx) in facultyLoads" :key="`i${idx}`">
                        <td>{{ item.schedule_id }}</td>
                        <td>{{ item.schedule.course.course_code }} {{ item.schedule.course.course_desc }}</td>
                        <td>{{ item.schedule.start_time | formatTime }} - {{ item.schedule.end_time | formatTime }}</td>
                        <td>
                            <span v-if="item.schedule.mon">M</span>
                            <span v-if="item.schedule.tue">T</span>
                            <span v-if="item.schedule.wed">W</span>
                            <span v-if="item.schedule.thu">TH</span>
                            <span v-if="item.schedule.fri">F</span>
                            <span v-if="item.schedule.sat">SAT</span>
                            <span v-if="item.schedule.sun">SUN</span>
                        </td>
                        <td>{{ item.schedule.room.room }}</td>
                        <td>
                            <b-button type="is-info" 
                                @click="studentList(item.schedule_id, item.user_id)"
                                icon-left="account" class="is-small is-outlined"></b-button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>    
</template>

<script>

export default{
    props: ['propAcadYears'],

    data() {
        return{
            acadYearId: 0,
            acadYears: [],

            facultyLoads: [],
        }
    },

    methods: {
        initData(){
            //this.acadYears = JSON.parse(this.propAcadYears)
            axios.get('/load-acadyears').then(res=>{
                this.acadYears = res.data
            }).catch(err=>{
            
            })
        },

        loadFacultyLoads(){
            const params = [
                `acadYearId=${this.acadYearId}`
            ].join('&')
            axios.get(`/get-faculty-faculty-loads?${params}`).then(res=>{
                this.facultyLoads = res.data
            })
        },

        studentList(id, fid){
            const params = [
                `scheduleid=${id}`,
                `facultyid=${fid}`,
                `academicid=${this.acadYearId}`
            ].join('&')

            window.location = `/faculty-student-list?${params}`;
        }
    },
    mounted(){
        this.initData()
    }
}
</script>


<style scoped>
.faculty-load{
    width: 100%;
}
.faculty-load th{
    padding: 15px;
    border-bottom: 1px solid rgb(189, 189, 189);
}

.faculty-load tr td{
    padding: 5px 15px;
}
</style>