<template>
    <div>
        <div>
            <p class="has-text-weight-bold mb-4 has-text-centered title is-5">MY COURSES</p>
        </div>

        <div class="columns">
            <div class="column">
                <b-field label="Academic Year">
                    <b-select v-model="search.academic_year_id">
                        <option v-for="(item,ix) in acadYears" 
                            :key="`ay${ix}`" 
                            :value="item.academic_year_id">
                            {{ item.academic_year_code }} - {{ item.academic_year_desc  }}
                        </option>
                    </b-select>
                </b-field>
            </div>

            <div class="column">
                <b-field label="Search Course">
                    <b-input v-model="search.course" type="text" placeholder="Search Course"></b-input>
                    <p class="control">
                        <b-button @click="loadMyCourses"
                            label="" icon-left="magnify" 
                            type="is-info"></b-button>
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
                        <th>Type</th>
                        <th>Schedule</th>
                        <th>Day</th>
                        <th>Unit</th>
                        <th>Grade</th>
                    </tr>
                    <tr v-for="(item, idx) in data" :key="`i${idx}`">
                        <td>{{ item.schedule_id }}</td>
                        <td>{{ item.schedule.course.course_code }} {{ item.schedule.course.course_desc }}</td>
                        <td>{{ item.schedule.course.course_type }}</td>
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
                        <td>{{ item.schedule.course.course_unit }}</td>
                        <td style="font-weight: bold; text-align:center;">
                            <span v-if="item.grade">
                                {{ item.grade.grade }}
                            </span>
                        </td>
                        
                    </tr>
                </table>

                <div class="buttons is-right mt-4">
                    <b-button tag="a"
                        href="/my-courses-print" 
                        class="is-outlined is-info" icon-left="printer"
                        label="PRINT PREVIEW"></b-button>
                </div>

                
            </div>
        </div>





    </div>    <!--root -->
</template>

<script>

export default{

    data() {
        return{

            data: [],

            acadYears: [],

            search: {
                course: '',
                academic_year_id: 0,
            },

            fields: {}

        }
    },

    methods: {
        
        loadMyCourses(){
            const params = [
                `acadyearid=${this.search.academic_year_id}`,
                `name=${this.search.course}`,
            ].join('&')
            axios.get(`/get-my-courses?${params}`).then(res=>{
                this.data = res.data
            })
        },

        loadAcademicYears(){
            axios.get(`/load-acadyears`).then(res=>{
                this.acadYears = res.data
            })
        },
    },

    mounted(){
        this.loadMyCourses()
        this.loadAcademicYears()
    },
    
    computed: {
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