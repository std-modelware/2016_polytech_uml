interface IAjaxView {
    Selector: string;
    Html: string;
}

interface IAjaxData {
    RedirectUrl?: string;
    ModalView? : IAjaxView;
    Views: IAjaxView[];
    ActionData: any;
}