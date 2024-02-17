<template>
    <div>

        <div class="section">

            <div class="columns is-centered">
                <div class="column is-8-widescreen is-11-desktop is-11-tablet">

                    <div class="columns">
                        <div class="column">
                            <b-field label="Financial Year"
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
                            
                            <div class="mb-2"><strong>UTILIZED BUDGET:</strong> {{ accountingUsedBudget | numberWithCommas }}</div>


                            <b-field label="Allotment Class" label-position="on-border"
                                expanded>
                                <b-select v-model="search.allotment_accounting"
                                    @input="loadAllotmentAccounting"
                                    expanded>
                                    <option v-for="(allot, ix) in allotmentClasses"
                                        :key="`allotclass${ix}`"
                                        :value="allot.allotment_class_id">{{ allot.allotment_class }}</option>
                                </b-select>
                            </b-field>

                            <div class="table-container">
                                <table class="table is-narrow is-fullwidth">
                                    <tr>
                                        <th>Document</th>
                                        <th>Allotment Class</th>
                                        <th>Allotment Account</th>
                                        <th>Allotment Allocated Budget</th>
                                        <th>Running Balance</th>
                                        <th>Financial Budget</th>
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
                                            {{ item.allotment_class }}
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
                                        <td>
                                            {{ item.financial_budget | numberWithCommas }}
                                        </td>
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

                    <div class="columns">
                        <div class="column">
                    
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
    },


    data(){
        return{
            search: {
               financial_year: {
                    financial_year_id: null,
                    financial_budget: null,
                    balance: null
               }
            },

            financialYears: [],

            accountingUtilizations: [],


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

        loadFinancialYears(){
            axios.get('/load-financial-years').then(res=>{
                this.financialYears = res.data
            })
        },

        loadData(){
            this.loadAccountingUtilizations()
            //this.loadBudgetingUtilizations()
            //this.loadProcurementUtilizations()
            this.loadAllotmentClasses()
        },

        loadAccountingUtilizations(){
            axios.get('/load-accounting-utilizations/' + this.search.financial_year['financial_year_id']).then(res=>{
                this.accountingUsedBudget = res.data
            })
        },

        // loadBudgetingUtilizations(){
        //     axios.get('/load-budgeting-utilizations/' + this.search.financial_year['financial_year_id']).then(res=>{
        //         this.budgetingUsedBudget = res.data
        //     })
        // },

        // loadProcurementUtilizations(){
        //     axios.get('/load-procurement-utilizations/' + this.search.financial_year['financial_year_id']).then(res=>{
        //         this.procurementUsedBudget = res.data
        //     })
        // },


        async loadAllotmentClasses(){
            await axios.get('/load-allotment-classes-by-financial/' + this.search.financial_year['financial_year_id']).then(res=>{
                this.allotmentClasses = res.data
            }).catch(err=>{

            })
        },



        ///////////
        loadAllotmentAccounting(){
            axios.get('/load-allotment-accounting/' + this.search.financial_year['financial_year_id'] + '/' + this.search.allotment_accounting).then(res=>{
                this.allotmentAccounting = res.data
            })
        },
        loadAllotmentBudgeting(){
            axios.get('/load-allotment-budgeting/' + this.search.financial_year['financial_year_id'] + '/' + this.search.allotment_budgeting).then(res=>{
                this.allotmentBudgeting = res.data
            })
        },
        loadAllotmentProcurement(){
            axios.get('/load-allotment-procurement/' + this.search.financial_year['financial_year_id'] + '/' + this.search.allotment_procurement).then(res=>{
                this.allotmentBudgeting = res.data
            })
        }
    },

  
    computed: {
        totalUtilizations(){
            return this.accountingUsedBudget
        }
    }

}

</script>