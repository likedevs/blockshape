<?php namespace App\Http\Controllers\Admin;

use App\Order;
use App\Services\Contracts\HtmlBuilder;
use App\UserHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Terranet\Administrator\Controller;
use URL;

class UserHistoryController extends Controller
{
    public function index()
    {
        $result = parent::index();

        $total = $this->getTotalAmountByQuery($result);

        return $result->with('total', $total);
    }
    
    /**
     * Preview document
     *
     * @param UserHistory $record
     * @param HtmlBuilder $builder
     * @return $this|mixed|string
     */
    public function preview(UserHistory $record, HtmlBuilder $builder)
    {
        $this->rememberReferrer();

        if (! $document = $record->document) {
            $document = $this->build($record, $builder);
        }

        return view("admin.user_history.preview", [
            'document' => $document,
            'record' => $record,
        ]);
    }

    protected function rememberReferrer()
    {
        if (URL::current() !== URL::previous()) {
            session()->set('back_url', URL::previous());
        }
    }

    public function rebuild(UserHistory $record, HtmlBuilder $builder)
    {
        $this->build($record, $builder);

        return redirect()->to('admin/history_records/preview/' . $record->id);
    }

    /**
     * Accept record
     *
     * @param UserHistory $record
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accept(UserHistory $record)
    {
        $record->approve();

        return redirect()->back();
    }

    /**
     * Decline record
     *
     * @param UserHistory $record
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function decline(UserHistory $record, Request $request)
    {
        $record->decline($request->get('declineReason'));

        return redirect()->back();
    }

    /**
     * @param UserHistory $record
     * @param HtmlBuilder $builder
     * @return $this
     */
    protected function build(UserHistory $record, HtmlBuilder $builder)
    {
        $record->fill([
            'document' => $document = $builder->build($record->user, $record),
            'accepted_at' => Carbon::now()
        ])->save();

        return $document;
    }

    /**
     * @param $result
     * @return string
     */
    private function getTotalAmountByQuery($result)
    {
        $query = clone $this->eloquent;
        $query = $query->scaffoldingQuery();

        $amount = Order::whereIn('user_history_id', $query->lists('id'))
            ->sum('amount');

        $siteId = \Request::get('site_id', site_id());

        $currency = site($siteId)->currency;
        $total = $result->getData()['total'];
        $total = "{$total} ({$amount} {$currency})";

        return $total;
    }
}
