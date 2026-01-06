<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div wire:ignore x-data="{ 
            state: $wire.$entangle('{{ $getStatePath() }}'),
            initEditor() {
                if (window.CKEDITOR_LOADED) {
                    this.createEditor();
                    return;
                }
                
                const script = document.createElement('script');
                script.src = 'https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js';
                script.onload = () => {
                    window.CKEDITOR_LOADED = true;
                    this.createEditor();
                };
                document.head.appendChild(script);

                // Add styles for text visibility
                const style = document.createElement('style');
                style.innerHTML = `
                    .ck-editor__editable {
                        color: #333 !important;
                        background-color: #fff !important;
                        min-height: 400px;
                    }
                    .ck.ck-editor__main > .ck-editor__editable:not(.ck-focused) {
                        border-color: #e5e7eb !important;
                    }
                    /* Ensure toolbar is visible in dark mode */
                    .ck-toolbar {
                        background-color: #f3f4f6 !important;
                        border-color: #e5e7eb !important;
                    }
                    .ck-toolbar .ck-label {
                        color: #333 !important;
                    }
                    .ck-reset_all * { 
                        color: #000; 
                    }
                `;
                document.head.appendChild(style);
            },
            createEditor() {
                ClassicEditor
                    .create(this.$refs.editor, {
                        toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo']
                    })
                    .then(editor => {
                        editor.model.document.on('change:data', () => {
                            this.state = editor.getData();
                        });
                        
                        // Set initial data
                        if (this.state) {
                            editor.setData(this.state);
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
         }" x-init="initEditor()">
        <div x-ref="editor"></div>
    </div>
</x-dynamic-component>