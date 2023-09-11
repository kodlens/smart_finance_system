<template>
    <div>
        <div>
            <p class="has-text-weight-bold mb-4 has-text-centered title is-5">FACULTY PROFILE</p>
        </div>

        <div class="columns">
            <div class="column">
                <b-field label="Identification No.">
                    <b-input
                        type="text"
                        v-model="faculty.ref_id"
                        placeholder="Identification No."></b-input>
                </b-field>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <b-field label="Last Name">
                    <b-input
                        type="text"
                        v-model="faculty.lname"
                        placeholder="Last Name"></b-input>
                </b-field>
            </div>
            <div class="column">
                <b-field label="First Name">
                    <b-input
                        type="text"
                        v-model="faculty.fname"
                        placeholder="First Name"></b-input>
                </b-field>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <b-field label="Middle Name">
                    <b-input
                        type="text"
                        v-model="faculty.mname"
                        placeholder="Middle Name"></b-input>
                </b-field>
            </div>
            <div class="column">
                <b-field label="Suffix">
                    <b-input
                        type="text"
                        v-model="faculty.suffix"
                        placeholder="Suffix"></b-input>
                </b-field>
            </div>
            <div class="column">
                <b-field label="Sex" expanded>
                    <b-select expanded
                        v-model="faculty.sex"
                        placeholder="Sex">
                        <option value="MALE">MALE</option>
                        <option value="FEMALE">FEMALE</option>
                    </b-select>
                </b-field>
            </div>
        </div>


        <div class="columns">
            <div class="column">
                <b-field label="Civil Status" expanded>
                    <b-select expanded
                        v-model="faculty.civil_status"
                        placeholder="Civil Status">
                        <option value="SINGLE">SINGLE</option>
                        <option value="MARRIED">MARRIED</option>
                        <option value="WIDOWED">WIDOWED</option>
                        <option value="SEPARATED">SEPARATED</option>
                    </b-select>
                </b-field>
            </div>

            <div class="column">
                <b-field label="Office">
                    <b-select expanded
                        v-model="faculty.office_id"
                        placeholder="Office">
                        <option v-for="(item, ix) in offices" :key="ix" 
                            :value="item.office_id">{{ item.office }}</option>
                    </b-select>
                </b-field>
            </div>
            <div class="column">
                <b-field label="Contact No.">
                    <b-input
                        type="text"
                        v-model="faculty.contact_no"
                        placeholder="Contact No."></b-input>
                </b-field>
            </div>
        </div>

        <!--address-->
        <hr>
        <div class="columns">
            <div class="column">
                <b-field label="Province" label-position="on-border" expanded
                            :type="this.errors.province ? 'is-danger':''"
                            :message="this.errors.province ? this.errors.province[0] : ''">
                    <b-select v-model="faculty.province" @input="loadCity" expanded>
                        <option v-for="(item, index) in provinces" :key="index" :value="item.provCode">{{ item.provDesc }}</option>
                    </b-select>
                </b-field>
            </div>

            <div class="column">
                <b-field label="City" label-position="on-border" expanded
                            :type="this.errors.city ? 'is-danger':''"
                            :message="this.errors.city ? this.errors.city[0] : ''">
                    <b-select v-model="faculty.city" @input="loadBarangay" expanded>
                        <option v-for="(item, index) in cities" :key="index" :value="item.citymunCode">{{ item.citymunDesc }}</option>
                    </b-select>
                </b-field>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <b-field label="Barangay" label-position="on-border" expanded
                            :type="this.errors.barangay ? 'is-danger':''"
                            :message="this.errors.barangay ? this.errors.barangay[0] : ''">
                    <b-select v-model="faculty.barangay" expanded>
                        <option v-for="(item, index) in barangays" :key="index" :value="item.brgyCode">{{ item.brgyDesc }}</option>
                    </b-select>
                </b-field>
            </div>
            <div class="column">
                <b-field label="Street" label-position="on-border">
                    <b-input v-model="faculty.street"
                                placeholder="Street">
                    </b-input>
                </b-field>
            </div>
        </div>

        <hr>

        <div class="buttons is-right">
            <b-button type="is-success"
                @click="submit"
                class="is-outlined"
                label="Update Information"></b-button>
        </div>

    </div>
</template>


<script>
export default{
    data(){
        return{
            faculty: {
                user_id: 0,
                ref_id: '',
                province: {
                    provCode: null
                },
                city: {
                    citymunCode: null,
                },
                barangay: {
                    brgyCode: null
                }
            },
            errors: {},

            offices: [],
            provinces: [],
            cities: [],
            barangays: [],
        }
    },

    methods: {
        loadAsyncData(){
            let tempData = null;
            //this.faculty = JSON.parse(this.propFaculty)
            axios.get('/faculty-profile-info').then(res=>{
                tempData = res.data;
                console.log(tempData)
                this.faculty.user_id = tempData.user_id
                this.faculty.ref_id = tempData.ref_id
                this.faculty.lname = tempData.lname
                this.faculty.fname = tempData.fname
                this.faculty.mname = tempData.mname
                this.faculty.suffix = tempData.suffix
                this.faculty.sex = tempData.sex
                this.faculty.civil_status = tempData.civil_status
                this.faculty.contact_no = tempData.contact_no
                this.faculty.office_id = tempData.office_id
                this.faculty.street = tempData.street
                this.faculty.province = tempData.province ? tempData.province.provCode: ''
                
                //load city first
                //console.log(this.faculty.res_province)
                axios.get('/load-cities?prov=' + this.faculty.province).then(res=>{
                    //load barangay
                    this.cities = res.data;
                    this.faculty.city = tempData.city ? tempData.city.citymunCode : '';

                    axios.get('/load-barangays?prov=' +this.faculty.province + '&city_code='+this.faculty.city).then(res=>{
                        this.barangays = res.data;
                        this.faculty.barangay = tempData.barangay ? tempData.barangay.brgyCode : '';

                    });
                });
            });
        },

        loadOffices(){
            axios.get('/load-offices').then(res=>{
                this.offices = res.data
            }).catch(err=>{
            
            })
        },

        loadProvince: function(){
            axios.get('/load-provinces').then(res=>{
                this.provinces = res.data;
            })
        },

        loadCity: function(){
            axios.get('/load-cities?prov=' + this.faculty.province).then(res=>{
                this.cities = res.data;
            })
        },

        loadBarangay: function(){
            axios.get('/load-barangays?prov=' + this.faculty.province + '&city_code='+this.faculty.city).then(res=>{
                this.barangays = res.data;
            })
        },

   


        submit(){
            axios.put('/faculty-profile/' + this.faculty.user_id, this.faculty).then(res=>{
                if(res.data.status === 'updated'){
                    this.$buefy.dialog.alert({
                        title: 'Updated.',
                        message: 'Information successfully updated.',
                        onConfirm: ()=> {
                            this.loadAsyncData();
                        }
                    })
                }
            }).catch(err=>{
            
            })
        }
    },

    mounted(){
        this.loadProvince()
        this.loadOffices()
        this.loadAsyncData()
    }
}

</script>