const { registerBlockType } = wp.blocks;
const { TextControl } = wp.components;
const { InspectorControls } = wp.blockEditor;
const { __ } = wp.i18n;

registerBlockType('tallbike-crew/tb_showDateandPlace', {
    title: __('TB-Block1', 'tallbike-crew'),
    icon: 'calendar',
    category: 'common',
    attributes: {
        eventId: {
            type: 'string',
            default: '',
        },
    },
    edit: (props) => {
        const { attributes: { eventId }, setAttributes } = props;

        return (
            <>
                <InspectorControls>
                    <TextControl
                        label={__('Event ID', 'tallbike-crew')}
                        value={eventId}
                        onChange={(value) => setAttributes({ eventId: value })}
                    />
                </InspectorControls>
                <div>
                    {__('Event Date: ', 'tallbike-crew')}
                    <span>{eventId ? `Event ID: ${eventId}` : __('No Event ID provided', 'tallbike-crew')}</span>
                </div>
            </>
        );
    },
    save: () => {
        return null; // Rendered in PHP
    },
});
/*wp.blocks.registerBlockType('tallbike-crew/tallbike_shortcodes_init', {
    title: 'Tallbike Tour Date and Place',
    icon: 'bike',
    category: 'widgets',
    edit: function(props) {
        return wp.element.createElement(
            'p',
            null,
            'This is a custom block!'
        );
    },
    save: function(props) {
        return wp.element.createElement(
            'p',
            null,
            'This is a custom block!'
        );
    },
});
*/