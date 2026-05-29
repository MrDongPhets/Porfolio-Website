import '../styles/pricing.css';

const CheckIcon = ({ className = '' }) => (
  <span className={`chk-icon ${className}`}>
    <svg
      width="14"
      height="14"
      viewBox="0 0 14 14"
      fill="none"
      strokeWidth="2"
      strokeLinecap="round"
      strokeLinejoin="round"
    >
      <polyline points="2,7 5.5,10.5 12,3.5" />
    </svg>
  </span>
);

const rows = [
  {
    label: 'Time to get started',
    gold: '48–72 hours',
    inhouse: { text: '1–3 months' },
    freelancer: { text: '1–3 weeks' },
  },

  {
    label: 'Services covered',
    gold: '5 areas, one team',
    inhouse: { text: 'One role only' },
    freelancer: { text: 'One skill only' },
  },

  {
    label: 'Coordination needed',
    gold: 'None — we handle it',
    inhouse: { text: 'High — you manage' },
    freelancer: {
      text: 'High — multiple people',
      wrap: true,
    },
  },

  {
    label: 'Consistent quality',
    gold: 'Standards-driven',
    inhouse: { text: 'Depends on hire' },
    freelancer: {
      text: 'Varies widely',
    },
  },

  {
    label: 'Values-driven team',
    gold: 'Built into culture',
    inhouse: { emptyCheck: true },
    freelancer: { emptyCheck: true },
  },

  {
    label: 'Flexible engagement',
    gold: 'Hourly packages — 20, 40, or 80hrs',
    inhouse: {
      text: 'Full-time salary',
      emptyCheck: true,
    },
    freelancer: {
      text: 'Inconsistent',
    },
  },

  {
    label: 'Dedicated point of contact',
    gold: 'Always',
    inhouse: {
      text: 'Depends on role',
    },
    freelancer: {
      emptyCheck: true,
    },
  },

  {
    label: 'Free trial available',
    gold: '2-hour free trial',
    inhouse: { emptyCheck: true },
    freelancer: { emptyCheck: true },
  },
];
const CompCell = ({
  text,
  warn,
  warnDim,
  emptyCheck,
  wrap,
}) => (
  <td className="td-other">
    <div
      className={`comp-cell${warn ? ' warn-text' : ''}${
        warnDim ? ' warn-dim' : ''
      }`}
      style={
        wrap
          ? {
              flexDirection: 'column',
              gap: '2px',
              lineHeight: 1.3,
            }
          : undefined
      }
    >
      {emptyCheck && (
  <span className="x-icon">
    ✕
  </span>
)}
      {text &&
        (wrap
          ? text
              .split(' — ')
              .map((part, i) => (
                <span key={i}>
                  {i > 0 ? `— ${part}` : part}
                </span>
              ))
          : text)}
    </div>
  </td>
);

export default function Pricing() {
  return (
    <section
      className="pricing-section"
      aria-label="Pricing comparison table"
    >
      <div className="pricing-container">
        <div className="pricing-header">
          <h2>
            One Team.{' '}
            <span className="gold">
              Better Results.
            </span>
            <br />
            Without the Overhead.
          </h2>

          <p>
            See how Mustard Digitals compares to building in-house or hiring freelancers — and why more businesses choose us.
          </p>
        </div>

        <div className="pricing-table-wrapper">
          <table className="pricing-table">
            <colgroup>
              <col className="c-empty" />
              <col className="c-gold" />
              <col className="c-other" />
              <col className="c-other" />
            </colgroup>

            <thead>
              <tr>
                <th className="th-empty" />

                <th className="th-gold">
                  <div className="mustard-card">
                    <div className="mustard-wordmark">
                      MUSTARD{' '}
                      <span className="gold">
                        Digitals
                      </span>
                    </div>

                    <div className="rec-badge">
                      Best Value
                    </div>
                  </div>
                </th>

                <th className="th-other">
                  In-House Hire
                </th>

                <th className="th-other">
                  Freelancers
                </th>
              </tr>
            </thead>

            <tbody>
              {rows.map(
                ({
                  label,
                  gold,
                  inhouse,
                  freelancer,
                }) => (
                  <tr
                  key={label}
                  className={
                    label === 'Free trial available'
                      ? 'highlight-row'
                      : ''
                  }
                >
                    <td className="td-label">
                      {label}
                    </td>

                    <td className="td-gold">
                      <div className="gold-value">
                        <CheckIcon />
                        {gold}
                      </div>
                    </td>

                    <CompCell {...inhouse} />

                    <CompCell {...freelancer} />
                  </tr>
                )
              )}
            </tbody>

            <tfoot>
              <tr className="invest-row">
                <td className="td-label invest-label-cell">
                  Typical investment
                </td>

                {/* MUSTARD */}
                <td className="td-gold">
                  <div className="invest-stack invest-stack--left">
                    <p className="price-big gold">
                      From $7/hr
                    </p>

                    <p className="invest-headline">
                      Flexible Packages
                    </p>

                    <p className="invest-note">
                      Hourly, project, or monthly
                    </p>
                  </div>
                </td>

                {/* INHOUSE */}
                <td className="td-other">
                  <div className="invest-stack invest-stack--center">
                    <p className="price-medium">
                      $3K–$6K+
                    </p>

                    <p className="invest-headline">
                      Per Month
                    </p>

                    <p className="invest-note">
                      Salary + benefits + tools
                    </p>
                  </div>
                </td>

                {/* FREELANCERS */}
                <td className="td-other">
                  <div className="invest-stack invest-stack--center">
                    <p className="price-medium">
                      Varies
                    </p>

                    <p className="invest-headline">
                      Unpredictable Costs
                    </p>

                    <p className="invest-note">
                      Different rates per task
                    </p>
                  </div>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </section>
  );
}