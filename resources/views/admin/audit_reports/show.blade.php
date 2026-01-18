<h4>{{ $audit_report->title }}</h4>

<p><b>Financial Year:</b> {{ $audit_report->financial_year }}</p>
<p><b>Report Type:</b> {{ $audit_report->report_type }}</p>
<p><b>CA:</b> {{ $audit_report->ca_name }}</p>
<p><b>UDIN:</b> {{ $audit_report->udid_number }}</p>
<p>{{ $audit_report->summary }}</p>

<a href="{{ route('admin.audit-reports.download',$audit_report->id) }}"
 class="btn btn-primary">Download</a>
