<?php
add_shortcode( 'ld_lesson_completed', function( $attr ) {
    $args = shortcode_atts( array(
            'lesson_id' => 0,
            'course_id' => 0,
            'user_id'   => get_current_user_id(),
        ), $attr );
    
    if( isset( $args['lesson_id'] ) && 0 == $args['lesson_id'] ) {
        return '<span class="ld-shortcode-ld-no-lesson">No Lesson ID Defined</span>';
    }
    
    $completed = false;
    if( $args['lesson_id'] > 0 && $args['course_id'] > 0 ) {
        $completed = learndash_is_lesson_complete( $args['user_id'], $args['lesson_id'], $args['course_id'] );
    }
    if( $args['lesson_id'] > 0 && 0 == $args['course_id'] ) {
        $completed = learndash_is_lesson_complete( $args['user_id'], $args['lesson_id'] );
    }
    
    if( isset( $completed ) && $completed !== false ) {
        return '<span class="ld-shortcode-ld-complete">Completed</span>';
    }
    
    return '<span class="ld-shortcode-ld-incomplete">Not Completed</span>';
});
