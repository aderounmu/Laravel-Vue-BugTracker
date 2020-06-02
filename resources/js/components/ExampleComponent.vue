<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                items:  [
                    {name: 'ade'},
                    {name: 'tade'},
                    {name: 'lade'},
                    {name: 'made'},
                    {name: 'kade'},
                    {name: 'dade'},
                    {name: 'fade'},
                    {name: 'pade'},
                    {name: 'gade'},
                    {name: 'fhade'},
                    {name: 'shaade'},
                    {name: 'sade'},
                    {name: 'bade'},
                    {name: 'blade'},
                ]
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
