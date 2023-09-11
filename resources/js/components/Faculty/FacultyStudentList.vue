<template>
    <div>
        <div>
            <p class="has-text-weight-bold mb-4 has-text-centered title is-5">STUDENT LIST</p>
        </div>

        <div class="columns">
            <div class="column">
                <b-field label="Search Name">
                    <b-input v-model="search.name" type="text" placeholder="Student Name"></b-input>
                    <p class="control">
                        <b-button @click="loadStudentList"
                            label="" icon-left="magnify" 
                            type="is-info"></b-button>
                    </p>
                </b-field>
            </div>
        </div>
        <hr>
        <div class="columns">
            <div class="column">
                <div class="schedule-container" v-if="schedule">
                    <div>
                        <b>Course: </b> <span>{{ schedule.course_code }} - {{ schedule.course_desc }}</span>
                    </div>
                    <div>
                        <b>Schedule: </b> <span>{{ schedule.start_time | formatTime }} - {{ schedule.end_time | formatTime }}</span>
                    </div>
                    <div>
                        <b>Day: </b> 
                            <span v-if="schedule.mon">M</span>
                            <span v-if="schedule.tue">T</span>
                            <span v-if="schedule.wed">W</span>
                            <span v-if="schedule.thu">TH</span>
                            <span v-if="schedule.fri">F</span>
                            <span v-if="schedule.sat">SAT</span>
                            <span v-if="schedule.sun">SUN</span>
                    </div>
                </div>
                <div v-else>
                    <div style="color: lightgray; font-weight: bold; text-align:center;">NOTHING FOUND...</div>
                </div>
                <hr>

                <table class="faculty-load">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Program & Year</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>

                    <tr v-for="(item, idx) in data" :key="`i${idx}`">
                        <td>{{ item.student.user_id }}</td>
                        <td>{{ item.student.lname }}, {{ item.student.lname }} {{ item.student.mname }}</td>
                        <td>{{ item.student.program.program_code }}</td>
                        <td style="font-weight: bold; text-align:center;">
                            <span v-if="item.grade">
                                {{ item.grade.grade }}
                            </span>
                        </td>
                         <td>
                            <b-tooltip label="Remove" class="is-danger">
                                <b-button type="is-danger" 
                                    @click="confirmRemoveStudent(item.student_list_id)"
                                    icon-left="delete" class="is-small is-outlined"></b-button>
                            </b-tooltip>
                            <b-tooltip label="Grade Entry" class="is-info">
                                <b-button type="is-info" 
                                    @click="modalGradeEntry(item.student_id, item.student_list_id)"
                                    icon-left="chart-donut" class="is-small is-outlined"></b-button>
                            </b-tooltip>
                        </td>
                    </tr>
                </table>

                <div class="mt-4">
                    <modal-browse-students
                        @browseStudents="emitBrowseStudents"></modal-browse-students>
                </div>
            </div>
        </div>






        <b-modal v-model="isModalActive" has-modal-card
                 trap-focus scroll="keep" aria-role="dialog" aria-modal>
            <div class="modal-card" style="max-width: 300px;">
                <header class="modal-card-head">
                    <p class="modal-card-title">Grade Entry</p>
                    <button type="button" class="delete"
                            @click="isModalActive = false" />
                </header>

                <section class="modal-card-body">
                    <div>
                        <b-field label="Grade">
                            <b-numberinput type="number" :controls="false"
                                v-model="fields.grade"></b-numberinput>
                        </b-field>

                    </div>
                </section>

                <footer class="modal-card-foot">
                    <b-button
                        label="Save"
                        type="is-success"
                        @click="submitGrade"></b-button>
                </footer>
            </div>
        </b-modal>



    </div>    <!--root -->
</template>

<script>

export default{

    props: ['propScheduleId', 'propFacultyId', 'propAcademicYearId'],

    data() {
        return{

            data: [],

            search: {
                name: '',
            },

            isModalActive: false,

            fields: {
                student_list_id: 0,
                schedule_id: 0,
                student_id: 0,
                faculty_id: 0,
                academic_year_id: 0
            }

        }
    },

    methods: {
        

        loadStudentList(){
            const params = [
                `sid=${this.propScheduleId}`,
                `fid=${this.propFacultyId}`,
                `acadyearid=${this.propAcademicYearId}`,
                `name=${this.search.name}`,
            ].join('&')
            axios.get(`/get-student-lists?${params}`).then(res=>{
                this.data = res.data
                //console.log(res.data)
            })
        },

        studentList(id, fid){

            window.location = '/faculty-student-list/' + id + '/' + fid;
        },

        emitBrowseStudents(row){
            console.log(row)

            let fields = {
                schedule_id: this.propScheduleId,
                faculty_id: this.propFacultyId,
                student_id: row.user_id,
            };
             
            axios.post('/faculty-student-list-store', fields).then(res=>{
                if(res.data.status === 'saved'){
                    this.$buefy.dialog.alert({
                        title: 'Added.',
                        message: 'Successfully added.',
                        type: 'is-info',
                        onConfirm: ()=> {
                            this.loadStudentList()
                        }
                    })
                }
            }).catch(err=>{
                this.errors = err.response.data.errors

                if(this.errors.exist){
                    this.$buefy.dialog.alert({
                        title: 'Exist.',
                        message: this.errors.exist[0],
                        type: 'is-danger'
                    })
                }
            })
        },


        confirmRemoveStudent(id){
            this.$buefy.dialog.confirm({
                title: 'Remove?',
                message: 'Are you sure you want to remove this student from the list?',
                type: 'is-info',
                onConfirm: () => {
                    this.removeSubmitStudent(id)
                }
            })
        },
        removeSubmitStudent(id){
            axios.delete('/faculty-student-list/' + id).then(res=>{
                if(res.data.status === 'deleted'){
                    this.$buefy.dialog.alert({
                        title: 'Deleted.',
                        message: 'Data deleted successfully.',
                        type: 'is-success'
                    })

                    this.loadStudentList()
                }
            })
        },

        modalGradeEntry(student_id, student_list_id){

            this.fields.student_list_id = student_list_id
            this.fields.schedule_id = this.propScheduleId
            this.fields.student_id = student_id
            this.fields.academic_year_id = this.propAcademicYearId
            this.fields.faculty_id = this.propFacultyId

            this.isModalActive = true
        },
        submitGrade(){
            axios.post('/grade-entry', this.fields).then(res=>{
                if(res.data.status === 'saved'){
                     this.isModalActive = false
                     
                    this.$buefy.dialog.alert({
                        title: 'Saved.',
                        message: 'Grade successfully saved.',
                        type: 'is-success',
                        onConfirm: ()=>{
                            this.clearFields()
                           
                            this.loadStudentList()
                        }
                    })
                }
            }).catch(err=>{
                //error here
            })
        },

        clearFields(){
            this.fields.student_list_id = 0
            this.fields.schedule_id = this.propScheduleId
            this.fields.student_id = 0
            this.fields.academic_year_id = this.propAcademicYearId
            this.fields.faculty_id = this.propFacultyId
            this.fields.grade = 0
        }
    },
    mounted(){
        this.loadStudentList()
    },
    
    computed: {
        schedule(){
            
            if(this.data.length > 0){
                return {
                    schedule_id: this.data[0].schedule.schedule_id,
                    course_code: this.data[0].schedule.course.course_code,
                    course_desc: this.data[0].schedule.course.course_desc,
                    start_time: this.data[0].schedule.start_time,
                    end_time: this.data[0].schedule.end_time,
                    mon: this.data[0].schedule.mon,
                    tue: this.data[0].schedule.tue,
                    wed: this.data[0].schedule.wed,
                    thu: this.data[0].schedule.thu,
                    fri: this.data[0].schedule.fri,
                    sat: this.data[0].schedule.sat,
                    sun: this.data[0].schedule.sun,
                }
            }
        }
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