<style>
    .ui-state-default {
        cursor: pointer;
    }

    .layout-height {
        min-height: 50px;
    }

    .widget-list {
        max-height: 400px;
        overflow-y: scroll;
    }

    .widget-single {
        display: inline-block;
        width: 100%;
        box-shadow: 5px 5px 10px -8px #bfbfbf;
        cursor: grab;
    }

    .section-widget {
        border-bottom: 1px solid #cbcbcd;
    }

    .widget-placeholder {
        border: 1px dotted black;
        height: 3.5rem;
        margin-bottom: 10px;
    }

    .widget-icons {
        visibility: hidden;
        transition-duration: 0.01s;
    }

    .section-widget:hover .widget-icons {
        visibility: visible;
        transition-duration: 0.01s;
    }

    .builder-sidebar .card-header i {
        transform: rotate(90deg);
        transition: 0.3s transform ease-in-out;
    }

    .builder-sidebar .card-header .collapsed i {
        transform: rotate(0deg);
    }

    #section_layout svg {
        height: 50px;
        width: 100%;
        cursor: pointer;
    }

    #section_layout svg path {
        fill: #d5dadf;
    }

    #section_layout svg path:hover {
        fill: #aaaaaa;
    }

    .img_layout {
        min-width: 115px;
        border-width: 4px;
        border-style: solid;
        border-color: #d9d9d9;
        cursor: pointer;
    }
</style>
