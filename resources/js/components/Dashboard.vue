<template>
    <div>

        <div class="section">

            <div class="columns is-centered">
                <div class="column is-10-widescreen is-11-desktop is-11-tablet">

                    <div class="columns">
                        <div class="column">
                            <b-field label="Financial Year" label-position="on-border"
                                expanded>
                                <b-select v-model="search.financial_year" expanded
                                    @input="loadData"
                                    placeholder="Financial Year">
                                    <option v-for="(item, indx) in financialYears"
                                        :key="`fy${indx}`"
                                        :value="{ 
                                            financial_year_id: item.financial_year_id,
                                            financial_budget: item.financial_budget,
                                            balance: item.balance
                                        }">
                                        {{ item.financial_year_code }}
                                        -
                                        {{ item.financial_year_desc }}
                                    </option>
                                </b-select>
                            </b-field>
                        </div>
                        <div class="column">
                            <b-field label="Fund Source" label-position="on-border"
                                expanded>
                                <b-select v-model="search.fund_source" expanded
                                    placeholder="Fund Source">
                                    <option value="">ALL</option>
                                    <option v-for="(item,index) in fundSources"
                                        :key="`fund${index}`" :value="item.fund_source">
                                        {{ item.fund_source }}</option>

                                </b-select>
                            </b-field>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <b-field label="Document Type" label-position="on-border"
                                expanded>
                                <b-select v-model="search.doc"
                                    expanded>
                                    <option value="ALL">ALL</option>
                                    <option value="ACCOUNTING">ACCOUNTING</option>
                                    <option value="BUDGETING">BUDGETING</option>
                                    <option value="PROCUREMENT">PROCUREMENT</option>
                                </b-select>
                            </b-field>
                        </div>
                        <div class="column">
                            <b-field label="Allotment Class" label-position="on-border"
                                expanded>
                                <b-select v-model="search.allotment_class"
                                    expanded>
                                    <option value="">ALL</option>
                                    <option v-for="(allot, ix) in allotmentClasses"
                                        :key="`allotclass${ix}`"
                                        :value="allot.allotment_class">{{ allot.allotment_class }}</option>
                                </b-select>
                            </b-field>
                        </div>

                        <div class="column">
                            <div class="buttons is-right">
                                <b-button type="is-primary" icon-right="magnify"
                                    @click="loadReportDashboardAccounting" label="Search"></b-button>
                            </div>
                        </div>
                    </div>

                    <div class="columns">
                        <div class="column">
                            <div>
                                <strong>FINANCIAL YEAR BUDGET:</strong> {{ search.financial_year['financial_budget'] | numberWithCommas }}
                            </div>
                            <div>
                                <strong>BALANCE:</strong> {{ search.financial_year['balance'] | numberWithCommas}}
                            </div>
                            <div>
                                <strong>TOTAL BUDGET UTILIZE: </strong> {{ totalUtilizations | numberWithCommas }}</div>

                        </div>
                    </div>

                    <hr>

                    <div class="columns">
                        <div class="column">
                            
                            <!-- <div class="mb-2"><strong>UTILIZED BUDGET:</strong> {{ budgetUtilize | numberWithCommas }}</div>
 -->

                            

                            <div class="table-container">
                                <table class="table is-narrow is-fullwidth">
                                    <tr>
                                        <th>Document</th>
                                        <th>Financial Budget</th>
                                        <th>Service Balance</th>
                                        <th>Allotment Class</th>
                                        <th>Allotment Class Budget</th>
                                        <th>Allotment Account</th>
                                        <th>Allotment Allocated Budget</th>
                                        <th>Running Balance</th>
                                        <!-- <th>Financial Budget</th> -->
                                        <th>Utilized Budget</th>
                                        <th>Priority Program</th>
                                        <th>Priority Program Code</th>
                                        <th>Priority Program Budget</th>
                                        <th>Priority Program Balance</th>
                                    </tr>
                                    <tr v-for="(item, index) in allotmentAccounting" :key="`allotment${index}`">
                                        <td>
                                            {{ item.doc_type }}
                                        </td>
                                        <td>
                                            {{ item.service_budget | numberWithCommas }}
                                        </td>
                                        <td>
                                            {{ item.service_balance | numberWithCommas }}
                                        </td>
                                        <td>
                                            {{ item.allotment_class }}
                                        </td>
                                        <td>
                                            {{ item.allotment_class_budget | numberWithCommas }}
                                        </td>
                                        <td>
                                            {{ item.allotment_class_account }}
                                        </td>
                                        <td>
                                            {{ item.allotment_class_account_budget | numberWithCommas }}
                                        </td>
                                        <td>
                                            {{ item.allotment_class_account_balance | numberWithCommas }}
                                        </td>
                                        <!-- <td>
                                            {{ item.financial_budget | numberWithCommas }}
                                        </td> -->
                                        <td>
                                            {{ item.amount | numberWithCommas }}
                                        </td>
                                        <td>
                                            {{ item.priority_program }}
                                        </td>
                                        <td>
                                            {{ item.priority_program_code }}
                                        </td>
                                        <td>
                                            {{ item.priority_program_budget | numberWithCommas }}
                                        </td>
                                        <td>
                                            {{ item.priority_program_balance | numberWithCommas }}
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>


                </div> <!--col-->
            </div><!--cols-->
        </div>
    </div>
</template>

<script>
export default{

    mounted(){
        this.loadFinancialYears()
        //this.loadFundSources()

    },


    data(){
        return{
            search: {
               financial_year: {
                    financial_year_id: null,
                    financial_budget: null,
                    balance: null
               },
               allotment_class: '',
               fund_source: '',
               doc: 'ALL'
            },

            financialYears: [],
            fundSources: [],

            accountingUtilizations: [],

            budgetUtilize: 0,
            
            accountingUsedBudget: 0,
            budgetingUsedBudget: 0,
            procurementUsedBudget: 0,

            allotmentClasses: [],

            allotmentAccounting: [],
            allotmentBudgeting: [],
            allotmentProcurement: [],

        }
    },

    methods: {

                ///////////
        loadReportDashboardAccounting(){
            const params = [
               
                `fy=${this.search.financial_year['financial_year_id']}`,
                `allotment=${this.search.allotment_class}`,
                `fundsource=${this.search.fund_source}`,
                `doc=${this.search.doc}`

            
            ].join('&')

            axios.get(`/load-report-dashboard-accounting?${params}`).then(res=>{
                this.allotmentAccounting = res.data
            })

            //this.loadAccountingUtilizations()
        },


        loadFinancialYears(){
            axios.get('/load-financial-years').then(res=>{
                this.financialYears = res.data
            })
        },

        loadAccountingUtilizations(){
            axios.get('/load-accounting-utilizations/' + this.search.financial_year['financial_year_id'] + '/?doc=' + this.search.doc).then(res=>{
                this.accountingUsedBudget = res.data
            })
        },

   


        loadFundSources(){
            axios.get('/load-fund-sources').then(res=>{
                this.fundSources = res.data
            })
        },
    },


    computed: {
        totalUtilizations(){
            return 0
            return this.accountingUsedBudget

           
            //
        }
    }

}

</script>