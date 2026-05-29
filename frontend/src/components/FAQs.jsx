import { useState } from 'react';
import '../styles/faqs.css';

const faqItems = [
  {
    question:
      'How is Mustard Digitals different from hiring a freelancer?',
    answer:
      'Freelancers are individuals — one skill, one person, often juggling multiple clients. Mustard Digitals is a coordinated team covering web design, branding, video editing, content, and VA support under one roof. You get consistent quality, a dedicated point of contact, and zero coordination headache. Think of us as your digital team — without the cost of hiring one in-house.',
  },

  {
  question: 'How does your pricing and packages work?',
  answer: (
    <>
      <p>
        We work on a flexible hourly package
        model. You purchase a block of hours
        and we apply them toward whichever
        services you need.
      </p>

      <p>Our hourly rates vary by service type:</p>

      <ul>
        <li>Graphics & Branding — $10/hr</li>
        <li>Video Editing — $10/hr</li>
        <li>
          Website Design & Development —
          $12/hr
        </li>
        <li>
          Customized Tech Solutions —
          $15/hr
        </li>
        <li>Admin & VA Support — $7/hr</li>
      </ul>

      <p>Choose from three package tiers:</p>

      <ul>
        <li>
          20 Hours — Standard rate,
          consumable within the month
        </li>
        <li>
          40 Hours — 10% off (Most
          Popular), consumable within the
          month
        </li>
        <li>
          80 Hours — 20% off (Best Value),
          consumable within the month
        </li>
      </ul>

      <p>
        No hidden fees. You pay for hours.
        We deliver value.
      </p>
    </>
  ),
},

  {
    question:
      'How quickly can we get started?',
    answer:
      "Once we've had a discovery call, aligned on scope, and estimated the hours needed — we can typically kick off within 48–72 hours. We move fast without cutting corners, and we'll keep you updated every step of the way.",
  },

  {
    question:
      'Is there really a free trial? What does it include?',
    answer:
      'Yes — completely free. We offer a 2-hour trial so you can experience the quality of our work before making any commitment. After your discovery call, submit a real task from any of our service areas — graphics, video, admin, web, or tech — and we’ll deliver real output within the trial hours. No payment required. No obligation to continue. Limited to one trial per business.',
  },

  {
    question:
      'Do unused hours roll over to the next month?',
    answer:
      'All packages — 20, 40, and 80 hours — are consumable within the month of purchase. We recommend planning your projects in advance so you get the most value out of every hour. Not sure how to maximize your hours? We’ll help you map it out during the discovery call.',
  },

  {
    question:
      'Are there any hidden fees?',
    answer:
      'None. Our pricing is straightforward — you purchase hours at the listed rates, and that’s what you pay. No setup fees, no surprise charges, no long-term commitments. What you see is what you get.',
  },

  {
    question:
      "What if I'm not happy with the output?",
    answer:
      "We include structured revision rounds so you have the opportunity to give feedback before final delivery. Our values of integrity and accountability mean we don't consider a project done until you're genuinely pleased with the result.",
  },

  {
    question:
      "I'm a small business — is Mustard Digitals right for me?",
    answer:
      'Absolutely. Small businesses and entrepreneurs are exactly who we built this for. Our hourly package model means you only pay for what you need — no bloated agency retainers, no full-time hire overhead. Start with our free 2-hour trial and see the difference firsthand before committing to a package.',
  },

  {
    question:
      'What does the process look like?',
    answer:
      'We follow a simple three-phase process we call Plant, Build, Grow. First we understand your goals through a discovery call — we align on scope, identify the right services, and estimate the hours needed. Then our team executes — designing, building, editing — tracking hours transparently as we go. Finally we deliver your files with a full walkthrough and close the project properly. Clean, clear, no surprises.',
  },

  {
    question:
      'Do you work with clients outside the Philippines?',
    answer:
      'Yes — we’re a remote-first team built to serve clients globally. We currently support businesses across the US, Australia, UK, and Canada. We adapt to your timezone for communication and ensure smooth collaboration regardless of location.',
  },

  {
    question:
      'Can I combine multiple services in one package?',
    answer:
      'Yes. Your package hours can be divided across multiple services — just let us know during the discovery call or before work begins. Once the allocation is agreed upon by both sides, the hours assigned to each service are reserved exclusively for that service and cannot be transferred or reallocated during the package period.',
  },

  {
  question: 'Do you offer discounts?',
  answer: (
    <>
      <p>
        Yes! We offer package discounts
        based on the number of hours
        purchased:
      </p>

      <ul>
        <li>
          20 Hours — Standard rate, no
          discount
        </li>
        <li>
          40 Hours — 10% off (Most
          Popular)
        </li>
        <li>
          80 Hours — 20% off (Best Value)
        </li>
      </ul>

      <p>
        All packages are consumable within
        the month of purchase.
      </p>
    </>
  ),
},
];
export default function FAQs() {
  const [openIndex, setOpenIndex] = useState(0);

  const toggleFAQ = (index) => {
    setOpenIndex(openIndex === index ? null : index);
  };

  return (
    <section className="faq-section" id="faq">
      <div className="faq-container">
        <span className="faq-label">Got Questions?</span>

        <h2 className="faq-heading">
          We&apos;ve Got <span>Answers.</span>
        </h2>

        <p className="faq-intro">
          Everything you need to know before working with us.
          Still not sure? Book a free consultation — no pressure,
          just a conversation.
        </p>

        <div className="faq-list">
          {faqItems.map((item, index) => (
            <div
              key={index}
              className={`faq-item ${
                openIndex === index ? 'open' : ''
              }`}
            >
              <button
                className="faq-question"
                onClick={() => toggleFAQ(index)}
              >
                <span>{item.question}</span>

                <span className="faq-icon">
                  {openIndex === index ? '−' : '+'}
                </span>
              </button>

              <div
  className={`faq-answer ${
    openIndex === index ? 'open' : ''
  }`}
>
  <p>{item.answer}</p>
</div>
            </div>
          ))}
        </div>

        <div className="faq-cta">
          <div className="faq-cta-copy">
            <h3>Still have a question we didn’t answer?</h3>

            <p>
              Book a free consultation — no pitch, no pressure.
              Just a conversation about your business and how we
              can help.
            </p>
          </div>

          
          <a
        href="https://calendly.com/mustarddigitalsolutions/30min?month=2026-05"
        target="_blank"
        rel="noopener noreferrer"
        className="faq-button"
      >
        <i className="fas fa-calendar"></i>
        Book a Free Discovery Call
      </a>
        </div>
      </div>
    </section>
  );
}