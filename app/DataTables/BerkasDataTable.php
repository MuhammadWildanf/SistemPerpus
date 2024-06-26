<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Auth;
use App\Models\Berka;
use App\Models\Document;
use App\Models\File;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BerkasDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('user_id', function ($row) {
                return $row->user ? $row->user->name : 'No User';
            })

            ->editColumn('jenis_file', function ($row) {
                // Ambil Dokumen Terkait dari Tabel Document
                $document = Document::find($row->jenis_file);

                // Periksa apakah Dokumen ditemukan
                if ($document) {
                    // Jika ditemukan, kembalikan nilai dari kolom 'dokumen'
                    return $document->dokumen;
                }

                return 'tidak ada'; // Jika tidak ada dokumen atau tidak ditemukan
            })

            ->addColumn('kategori', function ($row) {
                return optional($row->category)->kategori_ta;
            })

            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d-m-Y H:i:s');
            })
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at->format('d-m-Y H:i:s');
            })
            ->addIndexColumn('')
            ->addColumn('action', function ($row) {
                $action = '';


                // if (Gate::allows('update layanan/berkas')) {
                //     $action =  '<button type="button" data-id=' . $row->id . ' data-jenis="edit" class="btn btn-warning btn-sm action"><i class="ti-pencil"></i></button>';
                // }

                // if (Gate::allows('delete layanan/berkas')) {
                //     $action .=  ' <button type="button" data-id=' . $row->id . ' data-jenis="delete" class="btn btn-danger btn-sm action"><i class="ti-trash"></i></button>';
                // }

                if (Gate::allows('detail layanan/berkas')) {
                    $action .=  ' <button type="button" data-id=' . $row->id . ' data-jenis="detail" class="btn btn-info btn-sm action"><i class="ti-eye"></i></button>';
                }

                return $action;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Berka $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(File $model): QueryBuilder
    {
        $loggedInUserId = Auth::id();
        return $model->select(['id', 'user_id', 'kategori', 'jenis_file', 'status', 'created_at', 'updated_at'])
            ->where('user_id', $loggedInUserId);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('berkas-table')
            ->parameters(['searchDelay' => 1000])
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->searchable(false)->orderable(false),
            Column::make('created_at'),
            Column::make('user_id')->title('Nama Mahasiswa'),
            Column::make('kategori'),
            Column::make('jenis_file'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Berkas_' . date('YmdHis');
    }
}
