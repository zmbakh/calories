<template>
    <div>
        <div class="header pb-8 pt-5 pt-lg-6 d-flex align-items-center profile-header">
            <b-container fluid>
                <!-- Mask -->
                <span class="mask bg-gradient-success opacity-8"></span>
                <!-- Header container -->
                <b-container fluid class="d-flex align-items-center">

                </b-container>
            </b-container>
        </div>

        <b-container fluid class="mt--6">
            <b-row>
                <b-col xl="4" class="mb-5">
                    <card>
                        <b-row align-v="center" slot="header">
                            <b-col cols="8">
                                <h3 class="mb-0">Edit Food Entry</h3>
                            </b-col>
                        </b-row>

                        <validation-observer v-slot="{handleSubmit}" ref="formValidator">
                            <b-form role="form" @submit.prevent="handleSubmit(onSubmit)">
                                <div class="pl-lg-4">
                                    <b-row>
                                        <b-col lg="12">
                                            <p><span class="form-control-label">User</span><br>
                                            <span>{{ user.name }} {{ user.last_name }}</span></p>
                                        </b-col>
                                        <b-col lg="12">
                                            <base-input
                                                type="text"
                                                label="Food name"
                                                placeholder="Food name"
                                                name="Food name"
                                                v-model="model.name"
                                                :rules="{required: true}"
                                            >
                                            </base-input>
                                        </b-col>
                                        <b-col lg="12">
                                            <base-input
                                                type="number"
                                                label="Calories"
                                                placeholder="Calories"
                                                name="Calories"
                                                v-model="model.calories"
                                                :rules="{required: true}"
                                            >
                                            </base-input>
                                        </b-col>
                                        <b-col lg="12">
                                            <base-input
                                                type="number"
                                                label="Price"
                                                name="Price"
                                                placeholder="Price"
                                                v-model="model.price"
                                            >
                                            </base-input>
                                        </b-col>
                                        <b-col lg="12">
                                            <base-input
                                                type="datetime-local"
                                                name="Datetime"
                                                v-model="model.dateTime"
                                                label="Datetime"
                                                :rules="{required: true}"
                                            />
                                        </b-col>

                                        <b-col lg="12">
                                            <div class="text-center">
                                                <base-button type="primary" native-type="submit" block class="my-4">
                                                    Submit
                                                </base-button>
                                            </div>
                                        </b-col>
                                    </b-row>
                                </div>

                            </b-form>
                        </validation-observer>
                    </card>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>
<script>
import EditProfileForm from '@/views/Pages/UserProfile/EditProfileForm.vue';
import UserCard from '@/views/Pages/UserProfile/UserCard.vue';
import {format} from "date-fns";
import userRepository from "@/repositories/admin/user/userRepository";
import foodEntryRepository from "@/repositories/admin/food/foodEntryRepository";

export default {
    components: {
        EditProfileForm,
        UserCard
    },
    data() {
        return {
            user: {},
            model: {
                name: null,
                dateTime: null,
                calories: null,
                price: null,
            }
        };
    },
    mounted() {
        this.getFoodEntry();
    },
    methods: {
        onSubmit() {
            foodEntryRepository.update(this.$route.params.id, this.model).then(() => {
                this.$notify({
                    group: 'notification',
                    title: 'Food entry was successfully added',
                    position: 'top center',
                });
                this.$router.push({name: 'admin-food-entries'});
            });
        },
        getFoodEntry() {
            foodEntryRepository.show(this.$route.params.id).then(response => {
                this.user = response.data.user;
                this.model = {
                    name: response.data.name,
                    dateTime: format(response.data.date_time, 'YYYY-MM-DDTHH:mm'),
                    calories: response.data.calories,
                    price: response.data.price,
                };
            });
        }
    }
};
</script>
<style>
</style>
