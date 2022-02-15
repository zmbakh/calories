<template>
  <div>

    <base-header class="pb-6 pb-8 pt-5 pt-md-8 bg-gradient-success">
      <!-- Card stats -->
      <b-row>
        <b-col xl="3" md="6">
          <stats-card title="Calories For Today"
                      type="gradient-red"
                      sub-title="350,897"
                      icon="ni ni-active-40"
                      class="mb-4">

            <template slot="footer">
              <span class="text-success mr-2">3.48%</span>
              <span class="text-nowrap">Since last month</span>
            </template>
          </stats-card>
        </b-col>
        <b-col xl="3" md="6">
          <stats-card title="Money spent this month"
                      type="gradient-orange"
                      sub-title="2,356"
                      icon="ni ni-chart-pie-35"
                      class="mb-4">

            <template slot="footer">
              <span class="text-success mr-2">12.18%</span>
              <span class="text-nowrap">Since last month</span>
            </template>
          </stats-card>
        </b-col>
      </b-row>
    </base-header>

    <!--Charts-->
    <b-container fluid class="mt--7">
      <!--Tables-->
      <b-row class="sm-6">
        <b-col xl="8" class="mb-5 mb-xl-0">
            <b-row class="form-group">
                <b-col md="6" lg="4" xl="3">
                    <base-input label="Date From" type="date" v-model="date_from" />
                </b-col>
                <b-col md="6" lg="4" xl="3">
                    <base-input label="Date To" type="date" v-model="date_to"/>
                </b-col>
                <b-col md="6" lg="4" xl="3" class="mt-lg-4 pt-lg-2">
                    <base-button block type="primary">Button</base-button>
                </b-col>
            </b-row>
            <FoodEntriesTable/>
        </b-col>
      </b-row>
      <!--End tables-->
    </b-container>

  </div>
</template>
<script>
  // Components
  import StatsCard from '@/components/Cards/StatsCard';
  import FoodEntriesTable from "./Tables/FoodEntriesTable";
  import { format } from 'date-fns';


  export default {
    components: {
      StatsCard,
        FoodEntriesTable,
    },
    data() {
      return {
          date_from: (Date.now()),
          date_to: '',
      };
    },
    methods: {
        setDates() {
            let today = format(new Date(), 'YYYY-MM-DD');
            this.date_from = today;
            this.date_to = today;
        },

    },
    mounted() {
        this.setDates();
    }
  };
</script>
